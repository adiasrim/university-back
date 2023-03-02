<?php

namespace App\Models\Enums;

use Lazerg\LaravelEnumPro\EnumPro;

/**
 * @method static string ADMIN
 * @method static string TEACHER
 * @method static string STUDENT
 * @method static string MANAGER
 * @method static string PARENT
 */
enum UserTypes: string
{
    use EnumPro;

    case ADMIN = 'admin';
    case TEACHER = 'teacher';
}
