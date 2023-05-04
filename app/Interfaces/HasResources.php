<?php

namespace App\Interfaces;

interface HasResources
{
    public static function modelResourceClass(): string;
    public static function indexDashboardResourceClass(): string;
    public static function showDashboardResourceClass(): string;
    public static function indexAPIResourceClass(): string;
    public static function showAPIResourceClass(): string;
}
