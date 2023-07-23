<?php

namespace App\Http\Controllers\API\Course;

use App\Enums\CourseQuizQuestionTypes;
use App\Exceptions\Course\AlreadySubmitted;
use App\Exceptions\NotFound;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Course\Quiz\ShowQuizRequest;
use App\Http\Requests\API\Course\Quiz\SubmitQuizRequest;
use App\Http\Resources\API\Course\Items\Quiz\CourseQuizAPIResource;
use App\Models\CourseItem;
use App\Models\CourseQuiz;
use App\Models\CourseQuizQuestion;
use App\Models\CourseQuizQuestionOption;
use App\Models\QuizQuestionSubmission;
use App\Models\QuizSubmission;
use App\Traits\ChecksSubscription;
use Illuminate\Support\Facades\DB;

/**
 * @group Course
 * @subgroup Quiz
 */
class QuizController extends Controller
{
    use ChecksSubscription;

    /**
     * Show
     * @authenticated
     * @responseFile app/Http/Responses/Samples/Quiz/show.json
     * @responseFile 404 app/Http/Responses/Samples/not-found.json
     */
    public function show(string $itemId, ShowQuizRequest $request)
    {
        $item = CourseItem::byHash($itemId);
        return CourseQuizAPIResource::make($item->item);
    }

    /**
     * Submit
     * @authenticated
     * @response {}
     * @responseFile 404 app/Http/Responses/Samples/not-found.json
     * @responseFile 409 app/Http/Responses/Samples/Course/already-submitted.json
     */
    public function submit(string $itemId, SubmitQuizRequest $request)
    {
        /** @var CourseQuiz $quiz */
        $quiz = CourseItem::byHash($itemId)->item;
        $student = $this->getAuthenticatedStudent();
        if(!is_null(QuizSubmission::findForStudentAndQuiz($student->id, $quiz->id)))
            throw new AlreadySubmitted;


        DB::transaction(function() use ($request, $quiz, $student){
            $submission = QuizSubmission::create(['quiz_id' => $quiz->id, 'student_id' => $this->getAuthenticatedStudent()->id]);
            foreach($request->getAnswers() as $answer)
            {
                $questionId = CourseQuizQuestion::hashToId($answer['question_id']);
                /** @var CourseQuizQuestion $question */
                $question = $quiz->questions()->find($questionId);
                if(is_null($question))
                    throw new NotFound;

                switch($question->type){
                    case CourseQuizQuestionTypes::TEXT:
                        $json = json_encode(['text' => $answer['text_answer']]);
                        break;
                    case CourseQuizQuestionTypes::RADIO:
                        $optionId = CourseQuizQuestionOption::hashToId($answer['selected_option']);
                        $option = $question->options()->find($optionId);
                        if(is_null($option))
                            throw new NotFound();
                        $json = json_encode(['option' => $answer['selected_option']]);
                        break;
                    case CourseQuizQuestionTypes::CHECK:
                        $answers = [];
                        foreach($answer['selected_options'] as $selected_option){
                            $optionId = CourseQuizQuestionOption::hashToId($selected_option);
                            $option = $question->options()->find($optionId);
                            if(is_null($option))
                                throw new NotFound();
                            $answers[] = $selected_option;
                        }
                        $json = json_encode(['options' => $answers]);
                }
                QuizQuestionSubmission::create([
                    'course_quiz_question_id' => $questionId,
                    'quiz_submission_id' => $submission->id,
                    'answer' => $json,
                ]);
            }
        });

    }


}
