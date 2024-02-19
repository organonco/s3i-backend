import{r,o as l,f as d,w as t,a as s,b as a,t as g,c as C,F as V,g as M,h as B,n as F,e as b,d as $,i as R,v as O,j as w}from"./app-bdcf9ddf.js";import{_ as T}from"./MainLayout-14f73f89.js";import{_ as N,C as L}from"./CenterSheet-c32fda75.js";import{C as E}from"./ConfirmationDialog-9b122890.js";const W={name:"ChipWithBadge",props:["value","content"]};function K(n,e,o,f,z,Q){const p=r("v-chip"),y=r("v-badge");return o.value>0?(l(),d(y,{key:0,content:o.value,color:"warning"},{default:t(()=>[s(p,{color:"secondary"},{default:t(()=>[a(g(o.content),1)]),_:1})]),_:1},8,["content"])):(l(),d(p,{key:1,color:"secondary"},{default:t(()=>[a(g(o.content),1)]),_:1}))}const P=N(W,[["render",K]]),Z={name:"QuizSubmissionPreview",props:["answers"],data:function(){return{selected:["MV5K6ZQo"]}}};function A(n,e,o,f,z,Q){const p=r("v-row"),y=r("v-textarea"),v=r("v-checkbox-btn"),_=r("v-col"),k=r("v-radio"),c=r("v-radio-group"),q=r("v-divider"),u=r("v-list-item"),H=r("v-list");return l(),d(H,{lines:"two"},{default:t(()=>[(l(!0),C(V,null,M(this.answers,h=>(l(),d(u,null,{default:t(()=>[s(p,{class:"pa-4 v-locale--is-rtl",style:{"font-size":"x-large","font-weight":"bold"}},{default:t(()=>[a(g(h.quiz_question.object.text),1)]),_:2},1024),h.quiz_question.type==="text"?(l(),d(p,{key:0,class:"px-4 text-right v-locale--is-rtl"},{default:t(()=>[s(y,{modelValue:h.answer.text,"onUpdate:modelValue":m=>h.answer.text=m,readonly:""},null,8,["modelValue","onUpdate:modelValue"])]),_:2},1024)):B("",!0),h.quiz_question.type==="multiple_choice"?(l(),d(p,{key:1,class:"px-4 text-right v-locale--is-rtl"},{default:t(()=>[h.quiz_question.object.type==="check"?(l(),d(_,{key:0,cols:"12"},{default:t(()=>[(l(!0),C(V,null,M(h.quiz_question.object.options,m=>(l(),d(p,null,{default:t(()=>[s(v,{density:"compact",label:m.object.text,class:F(m.object.is_correct?"text-green":"text-red"),modelValue:h.answer.options,"onUpdate:modelValue":D=>h.answer.options=D,value:m.object.id,readonly:""},null,8,["label","class","modelValue","onUpdate:modelValue","value"])]),_:2},1024))),256))]),_:2},1024)):(l(),d(c,{key:1,modelValue:h.answer.option,"onUpdate:modelValue":m=>h.answer.option=m,readonly:""},{default:t(()=>[(l(!0),C(V,null,M(h.quiz_question.object.options,m=>(l(),d(k,{label:m.object.text,density:"compact",class:F("text-right "+(m.object.is_correct?"text-green":"text-red")),value:m.object.id},null,8,["label","class","value"]))),256))]),_:2},1032,["modelValue","onUpdate:modelValue"]))]),_:2},1024)):B("",!0),s(q,{class:"mt-2"})]),_:2},1024))),256))]),_:1})}const G=N(Z,[["render",A]]),J={style:{"font-size":"smaller","font-weight":"lighter"}},X={class:"pb-4"},Y=b("h3",{class:"pb-4"}," الاختبارات ",-1),x=b("h3",{class:"pb-4"}," الوظائف ",-1),ee=b("h3",{class:"pb-4"}," الاجتماعات ",-1),te=b("h3",{class:"pb-4"}," الطلاب ",-1),se=b("br",null,null,-1),oe=["href"],ie=["href"],le={class:"my-3"},ae=b("br",null,null,-1),ne={data:function(){return{loading:{students:0,feedback:!1,destroy_feedback:!1},classroomsData:{...this.$props.classrooms.data},headers:{students:[{title:"الاسم",key:"name_ar",align:"start"}],quizzes:[{title:"نوع الاختبار",key:"quiz_type",align:"start"},{title:"اسم الطالب",key:"student_name",align:"start"},{title:"الحالة",key:"status",align:"start"}],homeworks:[{title:"اسم الطالب",key:"student_name",align:"start"},{title:"الحالة",key:"status",align:"start"}],meetings:[{title:"اسم الاجتماع",key:"name",align:"start"},{title:"الحالة",key:"status",align:"start"}]},dialogs:{homework:!1,quiz:!1,meeting:!1,destroy_homework_feedback_confirmation:!1,destroy_quiz_feedback_confirmation:!1,destroy_meeting_information_confirmation:!1,quiz_submission_preview:!1},selected:{classroom:null,homework:null,quiz:null,meeting:null},forms:{homework:{feedback:""},quiz:{feedback:""},meeting:{date:"",time:"",url:""}}}},methods:{selectClassroom:function(n){this.openClassroom(n),this.fetchClassroom(n)},addLoaded:function(){this.loading.classroom=(this.loading.classroom+1)%5},fetchClassroom:function(n){this.loading.classroom=1,this.fetchStudents(n),this.fetchQuizzes(n),this.fetchHomeworks(n),this.fetchMeetings(n)},fetchStudents:function(n){w.get(route("classroom.students",this.classroomsData[n].id)).then(e=>{this.addLoaded(),this.classroomsData[n].students=e.data.data})},fetchQuizzes:function(n){w.get(route("classroom.quizzes",this.classroomsData[n].id)).then(e=>{this.addLoaded(),this.classroomsData[n].quizzes=e.data.data})},fetchHomeworks:function(n){w.get(route("classroom.homeworks",this.classroomsData[n].id)).then(e=>{this.addLoaded(),this.classroomsData[n].homeworks=e.data.data})},fetchMeetings:function(n){w.get(route("classroom.meetings",this.classroomsData[n].id)).then(e=>{this.addLoaded(),this.classroomsData[n].meetings=e.data.data})},openClassroom:function(n){if(this.selected.classroom==null){this.selected.classroom=n;return}this.closeClassroom();function e(o){return new Promise(f=>setTimeout(f,o))}e(700).then(()=>{this.selected.classroom=n})},closeClassroom:function(){this.selected.classroom=null},openHomeworksDialog:function(n,e){let o=e.item.raw.id;this.selectedClassroom.homeworks.forEach((f,z)=>{o===f.id&&(this.selected.homework=z)}),this.dialogs.homework=!0},openMeetingsDialog:function(n,e){let o=e.item.raw.id;this.selectedClassroom.meetings.forEach((f,z)=>{o===f.id&&(this.selected.meeting=z)}),this.selectedMeeting.is_set&&(this.forms.meeting.date=this.selectedMeeting.classroom_meeting.date,this.forms.meeting.time=this.selectedMeeting.classroom_meeting.time,this.forms.meeting.url=this.selectedMeeting.classroom_meeting.url),this.dialogs.meeting=!0},submitHomeworkFeedback:async function(n){this.loading.feedback=!0;var e=this.forms.homework.feedback;w.post(route("homework.feedback",this.selectedHomework.id),{feedback:e}).then(o=>{this.selectedHomework.has_feedback=!0,this.selectedHomework.feedback=e,this.loading.feedback=!1,this.forms.homework.feedback=null,this.selectedClassroom.number_of_pending_homeworks--})},submitQuizFeedback:async function(n){this.loading.feedback=!0;var e=this.forms.quiz.feedback;w.post(route("quiz.submission.feedback",this.selectedQuiz.id),{feedback:e}).then(o=>{this.selectedQuiz.has_feedback=!0,this.selectedQuiz.feedback=e,this.loading.feedback=!1,this.forms.homework.feedback=null,this.selectedClassroom.number_of_pending_quizzes--})},submitMeetingInformation:async function(n){this.forms.meeting.classroom_id=this.selectedClassroom.id,w.post(route("meeting.information",this.selectedMeeting.id),this.forms.meeting).then(e=>{this.selectedMeeting.is_set=!0,this.selectedMeeting.classroom_meeting={date:this.forms.meeting.date,time:this.forms.meeting.time,url:this.forms.meeting.url},this.selectedClassroom.number_of_pending_meetings--})},confirmHomeworkDestroyDialog:function(){this.loading.destroy_homework_feedback_confirmation=!0,w.delete(route("homework.feedback.destroy",{hash:this.selectedHomework.id})).then(()=>{this.selectedHomework.has_feedback=!1,this.selectedHomework.feedback=null,this.loading.destroy_homework_feedback_confirmation=!1,this.selectedClassroom.number_of_pending_homeworks++})},confirmQuizDestroyDialog:function(){this.loading.destroy_quiz_feedback_confirmation=!0,w.delete(route("quiz.submission.feedback.destroy",{hash:this.selectedQuiz.id})).then(()=>{this.selectedQuiz.has_feedback=!1,this.selectedQuiz.feedback=null,this.loading.destroy_quiz_feedback_confirmation=!1,this.selectedClassroom.number_of_pending_quizzes++})},activateDestroyHomeworkDialog:function(){this.dialogs.destroy_homework_feedback_confirmation=!0},activateDestroyQuizDialog:function(){this.dialogs.destroy_quiz_feedback_confirmation=!0},nextHomework:function(){this.selected.homework=(this.selected.homework+1)%this.selectedClassroom.homeworks.length,this.forms.homework.feedback=this.selectedHomework.feedback},previousHomework:function(){this.selected.homework=this.selected.homework===0?this.selectedClassroom.homeworks.length-1:this.selected.homework-1,this.forms.homework.feedback=this.selectedHomework.feedback},nextQuiz:function(){this.selected.quiz=(this.selected.quiz+1)%this.selectedClassroom.quizzes.length,this.forms.quiz.feedback=this.selectedQuiz.feedback},previousQuiz:function(){this.selected.quiz=this.selected.quiz===0?this.selectedClassroom.quizzes.length-1:this.selected.quiz-1,this.forms.quiz.feedback=this.selectedQuiz.feedback},nextMeeting:function(){this.selected.meeting=(this.selected.meeting+1)%this.selectedClassroom.meetings.length,this.selectedMeeting.is_set&&(this.forms.meeting.date=this.selectedMeeting.classroom_meeting.date,this.forms.meeting.time=this.selectedMeeting.classroom_meeting.time,this.forms.meeting.url=this.selectedMeeting.classroom_meeting.url)},previousMeeting:function(){this.selected.meeting=this.selected.meeting===0?this.selectedClassroom.meetings.length-1:this.selected.meeting-1,this.selectedMeeting.is_set&&(this.forms.meeting.date=this.selectedMeeting.classroom_meeting.date,this.forms.meeting.time=this.selectedMeeting.classroom_meeting.time,this.forms.meeting.url=this.selectedMeeting.classroom_meeting.url)},openQuizDialog:function(n,e){let o=e.item.raw.id;this.selectedClassroom.quizzes.forEach((f,z)=>{o===f.id&&(this.selected.quiz=z)}),this.dialogs.quiz_submission_preview=!1,this.dialogs.quiz=!0},fetchQuizSubmission:function(){var n=this.selectedClassroom.quizzes[this.selected.quiz].id;w.get(route("quiz.submission.show",n)).then(e=>{this.classroomsData[this.selected.classroom].quizzes[this.selected.quiz].answers=e.data.data.answers,this.classroomsData[this.selected.classroom].quizzes[this.selected.quiz].answers_fetched=!0})},openQuizSubmissionPreviewDialog:function(){this.selectedQuiz.answers_fetched||this.fetchQuizSubmission(),this.dialogs.quiz_submission_preview=!0},closeQuizSubmissionPreviewDialog:function(){this.dialogs.quiz_submission_preview=!1}},computed:{selectedClassroom:function(){return this.classroomsData[this.selected.classroom]},selectedHomework:function(){return this.selectedClassroom.homeworks[this.selected.homework]},selectedMeeting:function(){return this.selectedClassroom.meetings[this.selected.meeting]},selectedQuiz:function(){return this.selectedClassroom.quizzes[this.selected.quiz]},requiredRule:function(){return[n=>!!n||"مطلوب"]}}},fe=Object.assign(ne,{__name:"Index",props:{classrooms:Object,is_super_admin:Boolean},setup(n){return(e,o)=>{const f=r("v-card-title"),z=r("v-icon"),Q=r("v-card-subtitle"),p=r("v-card-text"),y=r("v-card"),v=r("v-col"),_=r("v-row"),k=r("v-divider"),c=r("v-chip"),q=r("v-data-table-virtual"),u=r("v-btn"),H=r("v-expand-transition"),h=r("v-container"),m=r("v-textarea"),D=r("v-card-actions"),S=r("v-form"),j=r("v-dialog"),U=r("v-text-field");return l(),d(T,{title:"لوحة التحكم"},{default:t(()=>[s(h,null,{default:t(()=>[s(_,null,{default:t(()=>[s(v,{cols:"3"},{default:t(()=>[s(L,null,{default:t(()=>[s(_,{class:"flex-row justify-center"},{default:t(()=>[(l(!0),C(V,null,M(e.classroomsData,(i,I)=>(l(),d(v,{cols:"12"},{default:t(()=>[s(y,{class:"text-center",onClick:de=>e.selectClassroom(I),variant:"outlined"},{default:t(()=>[s(f,{class:"mt-2",style:{"font-size":"larger","font-weight":"bolder"}},{default:t(()=>[a(g(i.name)+" ",1),b("div",J,g(i.course.category),1)]),_:2},1024),s(Q,null,{default:t(()=>[a(g(i.number_of_students)+" / "+g(i.course.students_limit)+" ",1),s(z,{icon:"mdi-account"})]),_:2},1024),s(p,null,{default:t(()=>[s(P,{class:"ma-1",value:i.number_of_pending_quizzes,content:"Quiz"},null,8,["value"]),s(P,{class:"ma-1",value:i.number_of_pending_homeworks,content:"Homework"},null,8,["value"]),s(P,{class:"ma-1",value:i.number_of_pending_meetings,content:"Meeting"},null,8,["value"])]),_:2},1024)]),_:2},1032,["onClick"])]),_:2},1024))),256))]),_:1})]),_:1})]),_:1}),s(v,{cols:"9"},{default:t(()=>[s(H,null,{default:t(()=>[e.selected.classroom?(l(),d(L,{key:0},{default:t(()=>[s(_,{justify:"center"},{default:t(()=>[b("h1",X,g(e.selectedClassroom.name),1),s(k,{class:"py-5"})]),_:1}),s(_,{justify:"center"},{default:t(()=>[s(v,{cols:"8",class:"pa-6"},{default:t(()=>[s(_,null,{default:t(()=>[s(v,{cols:"12"},{default:t(()=>[Y,s(k,{class:"pb-4",length:"40%"}),s(q,{"group-by":[{key:"quiz_name",order:"asc",align:"end"}],headers:e.headers.quizzes,items:e.selectedClassroom.quizzes,"onClick:row":e.openQuizDialog,class:"pa-3 elevation-1"},{"item.quiz_type":t(({item:i})=>[i.raw.quiz_type==="multiple_choice"?(l(),C(V,{key:0},[a(" اختيار من متعدد ")],64)):(l(),C(V,{key:1},[a(" نصي ")],64))]),"item.status":t(({item:i})=>[i.raw.has_feedback?(l(),d(c,{key:0,color:"success"},{default:t(()=>[a(" تم التصحيح ")]),_:1})):i.raw.quiz_type==="multiple_choice"?(l(),d(c,{key:1,color:"success"},{default:t(()=>[a(" تم التصحيح التلقائي ")]),_:1})):(l(),d(c,{key:2,color:"warning"},{default:t(()=>[a(" بانتظار التصحيح ")]),_:1}))]),_:1},8,["headers","items","onClick:row"])]),_:1})]),_:1}),s(_,null,{default:t(()=>[s(v,{cols:"12"},{default:t(()=>[x,s(k,{class:"pb-4",length:"40%"}),s(q,{"group-by":[{key:"homework_name",order:"asc",align:"end"}],headers:e.headers.homeworks,items:e.selectedClassroom.homeworks,"item-value":"name","onClick:row":e.openHomeworksDialog,class:"pa-3 elevation-1"},{"item.status":t(({item:i})=>[i.raw.has_feedback?(l(),d(c,{key:0,color:"success"},{default:t(()=>[a(" تم التصحيح ")]),_:1})):(l(),d(c,{key:1,color:"warning"},{default:t(()=>[a(" بانتظار التصحيح ")]),_:1}))]),_:1},8,["headers","items","onClick:row"])]),_:1})]),_:1}),s(_,null,{default:t(()=>[s(v,{cols:"12"},{default:t(()=>[ee,s(k,{class:"pb-4",length:"40%"}),s(q,{headers:e.headers.meetings,items:e.selectedClassroom.meetings,"item-value":"name","onClick:row":e.openMeetingsDialog,class:"pa-3 elevation-1"},{"item.status":t(({item:i})=>[i.raw.is_set?(l(),d(c,{key:0,color:"success"},{default:t(()=>[a(" تم التحديد ")]),_:1})):(l(),d(c,{key:1,color:"warning"},{default:t(()=>[a(" بانتظار التحديد ")]),_:1}))]),_:1},8,["headers","items","onClick:row"])]),_:1})]),_:1})]),_:1}),s(v,{cols:"4",class:"pa-6"},{default:t(()=>[te,s(k,{class:"pb-4",length:"40%"}),s(q,{headers:e.headers.students,items:e.selectedClassroom.students,class:"pa-3 elevation-1"},null,8,["headers","items"])]),_:1})]),_:1}),s(_,{"align-content":"center"},{default:t(()=>[s(u,{variant:"text",onClick:e.closeClassroom,width:"100%"},{default:t(()=>[a(" إغلاق")]),_:1},8,["onClick"])]),_:1})]),_:1})):B("",!0)]),_:1})]),_:1})]),_:1})]),_:1}),s(j,{modelValue:e.dialogs.homework,"onUpdate:modelValue":o[2]||(o[2]=i=>e.dialogs.homework=i),width:"auto",height:"auto"},{default:t(()=>[s(y,{width:"800px"},{default:t(()=>[s(S,{onSubmit:$(e.submitHomeworkFeedback,["prevent"])},{default:t(()=>[s(f,{class:"text-center"},{default:t(()=>[e.selectedHomework.has_feedback?(l(),d(c,{key:0,color:"success",class:"my-3"},{default:t(()=>[a(" تم التصحيح ")]),_:1})):(l(),d(c,{key:1,color:"warning",class:"my-3"},{default:t(()=>[a(" بانتظار التصحيح")]),_:1})),se,a(" "+g(e.selectedHomework.homework_name),1)]),_:1}),s(Q,{class:"text-center"},{default:t(()=>[a(g(e.selectedHomework.student_name),1)]),_:1}),s(k,{class:"my-4"}),s(p,{class:"text-center"},{default:t(()=>[b("a",{href:e.selectedHomework.file_url,download:""},[s(u,{variant:"outlined",color:"black",class:"mb-12 mr-5"},{default:t(()=>[a(" تحميل حل الطالب ")]),_:1})],8,oe),b("a",{href:e.selectedHomework.file_url,target:"_blank"},[s(u,{variant:"outlined",color:"black",class:"mb-12"},{default:t(()=>[a(" عرض حل الطالب")]),_:1})],8,ie),e.selectedHomework.has_feedback?(l(),d(m,{key:0,class:"v-locale--is-rtl text-success",variant:"filled",modelValue:e.selectedHomework.feedback,"onUpdate:modelValue":o[0]||(o[0]=i=>e.selectedHomework.feedback=i),readonly:""},null,8,["modelValue"])):(l(),d(m,{key:1,label:"النتيجة",class:"v-locale--is-rtl",variant:"outlined",rules:e.requiredRule,name:"submission",modelValue:e.forms.homework.feedback,"onUpdate:modelValue":o[1]||(o[1]=i=>e.forms.homework.feedback=i)},null,8,["rules","modelValue"]))]),_:1}),s(k),s(D,{class:"pa-8"},{default:t(()=>[s(_,{class:"justify-space-between"},{default:t(()=>[s(u,{variant:"text",onClick:e.nextHomework},{default:t(()=>[a(" التالي ")]),_:1},8,["onClick"]),e.selectedHomework.has_feedback?(l(),d(u,{key:0,color:"error",width:"250px",variant:"outlined",onClick:e.activateDestroyHomeworkDialog},{default:t(()=>[a(" حذف التصحيح ")]),_:1},8,["onClick"])):(l(),d(u,{key:1,variant:"outlined",width:"250px",color:"success",type:"submit"},{default:t(()=>[a(" تصحيح ")]),_:1})),s(u,{variant:"text",onClick:e.previousHomework},{default:t(()=>[a(" السابق ")]),_:1},8,["onClick"])]),_:1})]),_:1})]),_:1},8,["onSubmit"])]),_:1})]),_:1},8,["modelValue"]),s(j,{modelValue:e.dialogs.quiz,"onUpdate:modelValue":o[7]||(o[7]=i=>e.dialogs.quiz=i),width:"auto",height:"auto"},{default:t(()=>[s(y,{width:"800"},{default:t(()=>[s(S,{onSubmit:$(e.submitQuizFeedback,["prevent"])},{default:t(()=>[s(f,{class:"text-center"},{default:t(()=>[b("div",le,[e.selectedQuiz.has_feedback?(l(),d(c,{key:0,color:"success"},{default:t(()=>[a(" تم التصحيح ")]),_:1})):e.selectedQuiz.quiz_type==="multiple_choice"?(l(),d(c,{key:1,color:"success"},{default:t(()=>[a(" تم التصحيح التلقائي ")]),_:1})):(l(),d(c,{key:2,color:"warning"},{default:t(()=>[a(" بانتظار التصحيح ")]),_:1}))]),a(" "+g(e.selectedQuiz.quiz_name),1)]),_:1}),s(Q,{class:"text-center"},{default:t(()=>[a(g(e.selectedQuiz.student_name),1)]),_:1}),s(k,{class:"my-4"}),s(p,{class:"text-center"},{default:t(()=>[e.dialogs.quiz_submission_preview?(l(),C("div",{key:0,onClick:o[3]||(o[3]=(...i)=>e.closeQuizSubmissionPreviewDialog&&e.closeQuizSubmissionPreviewDialog(...i)),class:"mb-6"},[a(" اخفاء حل الطالب "),s(u,{icon:"mdi-chevron-up",variant:"flat"})])):(l(),C("div",{key:1,onClick:o[4]||(o[4]=(...i)=>e.openQuizSubmissionPreviewDialog&&e.openQuizSubmissionPreviewDialog(...i)),class:"mb-6"},[a(" عرض حل الطالب "),s(u,{icon:"mdi-chevron-down",variant:"flat"})])),s(H,null,{default:t(()=>[R(b("div",null,[s(G,{answers:e.selectedQuiz.answers},null,8,["answers"])],512),[[O,e.dialogs.quiz_submission_preview]])]),_:1}),e.selectedQuiz.has_feedback?(l(),d(m,{key:2,class:"v-locale--is-rtl text-success",variant:"filled",modelValue:e.selectedQuiz.feedback,"onUpdate:modelValue":o[5]||(o[5]=i=>e.selectedQuiz.feedback=i),readonly:""},null,8,["modelValue"])):(l(),d(m,{key:3,label:"النتيجة",class:"v-locale--is-rtl",variant:"outlined",rules:e.requiredRule,name:"submission",modelValue:e.forms.quiz.feedback,"onUpdate:modelValue":o[6]||(o[6]=i=>e.forms.quiz.feedback=i)},null,8,["rules","modelValue"]))]),_:1}),s(k),s(D,{class:"pa-8"},{default:t(()=>[s(_,{class:"justify-space-between"},{default:t(()=>[s(u,{variant:"text",onClick:e.nextQuiz},{default:t(()=>[a(" التالي ")]),_:1},8,["onClick"]),e.selectedQuiz.has_feedback?(l(),d(u,{key:0,color:"error",width:"250px",variant:"outlined",onClick:e.activateDestroyQuizDialog},{default:t(()=>[a(" حذف التصحيح ")]),_:1},8,["onClick"])):(l(),d(u,{key:1,variant:"outlined",width:"250px",color:"success",type:"submit"},{default:t(()=>[a(" تصحيح ")]),_:1})),s(u,{variant:"text",onClick:e.previousQuiz},{default:t(()=>[a(" السابق ")]),_:1},8,["onClick"])]),_:1})]),_:1})]),_:1},8,["onSubmit"])]),_:1})]),_:1},8,["modelValue"]),s(j,{modelValue:e.dialogs.meeting,"onUpdate:modelValue":o[11]||(o[11]=i=>e.dialogs.meeting=i),width:"auto",height:"auto"},{default:t(()=>[s(y,{width:"800px"},{default:t(()=>[s(S,{onSubmit:$(e.submitMeetingInformation,["prevent"])},{default:t(()=>[s(f,{class:"text-center"},{default:t(()=>[e.selectedMeeting.is_set?(l(),d(c,{key:0,color:"success",class:"my-3"},{default:t(()=>[a(" تم التحديد ")]),_:1})):(l(),d(c,{key:1,color:"warning",class:"my-3"},{default:t(()=>[a(" بانتظار التحديد")]),_:1})),ae,a(" "+g(e.selectedMeeting.name),1)]),_:1}),s(k,{class:"my-4"}),s(p,{class:"text-center"},{default:t(()=>[s(U,{modelValue:e.forms.meeting.url,"onUpdate:modelValue":o[8]||(o[8]=i=>e.forms.meeting.url=i),label:"رابط الاجتماع",variant:"outlined","prepend-icon":"mdi-link"},null,8,["modelValue"]),s(U,{modelValue:e.forms.meeting.date,"onUpdate:modelValue":o[9]||(o[9]=i=>e.forms.meeting.date=i),type:"date",label:"وقت الاجتماع",variant:"outlined","prepend-icon":"mdi-clock"},null,8,["modelValue"]),s(U,{modelValue:e.forms.meeting.time,"onUpdate:modelValue":o[10]||(o[10]=i=>e.forms.meeting.time=i),type:"time",label:"تاريخ الاجتماع",variant:"outlined","prepend-icon":"mdi-calendar"},null,8,["modelValue"])]),_:1}),s(k),s(D,{class:"pa-8"},{default:t(()=>[s(_,{class:"justify-space-between"},{default:t(()=>[s(u,{variant:"text",onClick:e.nextMeeting},{default:t(()=>[a(" التالي ")]),_:1},8,["onClick"]),s(u,{variant:"outlined",width:"250px",color:"success",type:"submit"},{default:t(()=>[a(" حفظ ")]),_:1}),s(u,{variant:"text",onClick:e.previousMeeting},{default:t(()=>[a(" السابق ")]),_:1},8,["onClick"])]),_:1})]),_:1})]),_:1},8,["onSubmit"])]),_:1})]),_:1},8,["modelValue"]),s(E,{modelValue:e.dialogs.destroy_quiz_feedback_confirmation,"onUpdate:modelValue":o[12]||(o[12]=i=>e.dialogs.destroy_quiz_feedback_confirmation=i),title:"حذف التصحيح",onConfirm:e.confirmQuizDestroyDialog},null,8,["modelValue","onConfirm"]),s(E,{modelValue:e.dialogs.destroy_homework_feedback_confirmation,"onUpdate:modelValue":o[13]||(o[13]=i=>e.dialogs.destroy_homework_feedback_confirmation=i),title:"حذف التصحيح",onConfirm:e.confirmHomeworkDestroyDialog},null,8,["modelValue","onConfirm"])]),_:1})}}});export{fe as default};
