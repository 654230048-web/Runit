<?php
function base_url(string $path = ''): string
{
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $dirName = dirname($scriptName);
    $baseUrl = rtrim(str_replace('\\', '/', $dirName), '/');
    if ($baseUrl === '' || $baseUrl === '/') {
        $baseUrl = '';
    }
    $path = ltrim($path, '/');
    return $baseUrl . ($path ? '/' . $path : '');
}

function cleanInput(string $data): string
{
    return htmlspecialchars(stripslashes(trim($data)), ENT_QUOTES, 'UTF-8');
}

function formatDateThai(string $date): string
{
    if (empty($date) || $date === '0000-00-00') return '-';
    $months = [1=>'ม.ค.', 2=>'ก.พ.', 3=>'มี.ค.', 4=>'เม.ย.', 5=>'พ.ค.', 6=>'มิ.ย.', 7=>'ก.ค.', 8=>'ส.ค.', 9=>'ก.ย.', 10=>'ต.ค.', 11=>'พ.ย.', 12=>'ธ.ค.'];
    $ts = strtotime($date);
    $day = (int)date('j', $ts);
    $month = $months[(int)date('n', $ts)];
    $year = (int)date('Y', $ts) + 543;
    return "{$day} {$month} {$year}";
}
