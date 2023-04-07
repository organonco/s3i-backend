<?php

namespace App\Interfaces;

interface HasCourseItemInterface
{
    public function courseItem();
    public function course();
    public function getResourceClass() : string;
    public function getAPIResourceClass() : string;
}
