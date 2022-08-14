<?php
/**
 * CoreBeat SyStem Manager
 * @author Gabor Erdi [gabor.erdi@aninet.eu]
 * @version v002
 * @date 18/09/20
 */
if ( !defined('H-KEI') ) { die; }

/**
 * Userfriendly date format.. probably
 * @param string $time (MYSQL format)
 * @return string date-text
 */
function cb_date_for_user(int $time): string
{
    $ret = "";

    $today = time();
    $oneDay = strtotime("+1 day", $today);
    $yesterday = strtotime("-1 day", $today);
    $day2 = strtotime("-2 day", $today);
    $day3 = strtotime("-3 day", $today);
    $day4 = strtotime("-4 day", $today);
    $day5 = strtotime("-5 day", $today);
    $day6 = strtotime("-6 day", $today);
    $day7 = strtotime("-7 day", $today);
    $weak1 = strtotime("-1 weak", $today);
    $weak2 = strtotime("-2 weak", $today);
    $weak3 = strtotime("-3 weak", $today);
    $weak4 = strtotime("-4 weak", $today);
    $weak5 = strtotime("-5 weak", $today);
    $month1 = strtotime("-1 month", $today);
    $month2 = strtotime("-2 month", $today);
    $month3 = strtotime("-3 month", $today);
    $month4 = strtotime("-4 month", $today);
    $month5 = strtotime("-5 month", $today);
    $month6 = strtotime("-6 month", $today);
    $month7 = strtotime("-7 month", $today);
    $month8 = strtotime("-8 month", $today);
    $month9 = strtotime("-9 month", $today);
    $month10 = strtotime("-10 month", $today);
    $month11 = strtotime("-11 month", $today);
    $month12 = strtotime("-12 month", $today);
    $year1 = strtotime("-1 year", $today);
    $year2 = strtotime("-2 year", $today);
    $year3 = strtotime("-3 year", $today);
    $year4 = strtotime("-4 year", $today);
    $year5 = strtotime("-5 year", $today);
    $year6 = strtotime("-6 year", $today);
    $year7 = strtotime("-7 year", $today);
    $year8 = strtotime("-8 year", $today);
    $year9 = strtotime("-9 year", $today);
    $year10 = strtotime("-10 year", $today);
    $year11 = strtotime("-11 year", $today);

    if ($time - $yesterday >= 0) {
        $ret = "[LANG_SYS_DATE_TODAY]";
    } elseif ($time - $day2 >= 0) {
        $ret = "[LANG_SYS_DATE_YESTERDAY]";
    } elseif ($time - $day3 >= 0) {
        $ret = "2 [LANG_SYS_DATE_DAYS_AGO]";
    } elseif ($time - $day4 >= 0) {
        $ret = "3 [LANG_SYS_DATE_DAYS_AGO]";
    } elseif ($time - $day5 >= 0) {
        $ret = "4 [LANG_SYS_DATE_DAYS_AGO]";
    } elseif ($time - $day6 >= 0) {
        $ret = "5 [LANG_SYS_DATE_DAYS_AGO]";
    } elseif ($time - $day7 >= 0) {
        $ret = "6 [LANG_SYS_DATE_DAYS_AGO]";
    } elseif ($time - $weak2 >= 0) {
        $ret = "1 [LANG_SYS_DATE_WEAK_AGO]";
    } elseif ($time - $weak3 >= 0) {
        $ret = "2 [LANG_SYS_DATE_WEAKS_AGO]";
    } elseif ($time - $weak4 >= 0) {
        $ret = "3 [LANG_SYS_DATE_WEAKS_AGO]";
    } elseif ($time - $weak5 >= 0) {
        $ret = "4 [LANG_SYS_DATE_WEAKS_AGO]";
    } elseif ($time - $month2 >= 0) {
        $ret = "1 [LANG_SYS_DATE_MONTH_AGO]";
    } elseif ($time - $month3 >= 0) {
        $ret = "2 [LANG_SYS_DATE_MONTHS_AGO]";
    } elseif ($time - $month4 >= 0) {
        $ret = "3 [LANG_SYS_DATE_MONTHS_AGO]";
    } elseif ($time - $month5 >= 0) {
        $ret = "4 [LANG_SYS_DATE_MONTHS_AGO]";
    } elseif ($time - $month6 >= 0) {
        $ret = "5 [LANG_SYS_DATE_MONTHS_AGO]";
    } elseif ($time - $month7 >= 0) {
        $ret = "6 [LANG_SYS_DATE_MONTHS_AGO]";
    } elseif ($time - $month8 >= 0) {
        $ret = "7 [LANG_SYS_DATE_MONTHS_AGO]";
    } elseif ($time - $month9 >= 0) {
        $ret = "8 [LANG_SYS_DATE_MONTHS_AGO]";
    } elseif ($time - $month10 >= 0) {
        $ret = "9 [LANG_SYS_DATE_MONTHS_AGO]";
    } elseif ($time - $month11 >= 0) {
        $ret = "10 [LANG_SYS_DATE_MONTHS_AGO]";
    } elseif ($time - $month12 >= 0) {
        $ret = "11 [LANG_SYS_DATE_MONTHS_AGO]";
    } elseif ($time - $year2 >= 0) {
        $ret = "1 [LANG_SYS_DATE_YEAR_AGO]";
    } elseif ($time - $year3 >= 0) {
        $ret = "2 [LANG_SYS_DATE_YEARS_AGO]";
    } elseif ($time - $year4 >= 0) {
        $ret = "3 [LANG_SYS_DATE_YEARS_AGO]";
    } elseif ($time - $year5 >= 0) {
        $ret = "4 [LANG_SYS_DATE_YEARS_AGO]";
    } elseif ($time - $year6 >= 0) {
        $ret = "5 [LANG_SYS_DATE_YEARS_AGO]";
    } elseif ($time - $year7 >= 0) {
        $ret = "6 [LANG_SYS_DATE_YEARS_AGO]";
    } elseif ($time - $year8 >= 0) {
        $ret = "7 [LANG_SYS_DATE_YEARS_AGO]";
    } elseif ($time - $year9 >= 0) {
        $ret = "8 [LANG_SYS_DATE_YEARS_AGO]";
    } elseif ($time - $year10 >= 0) {
        $ret = "9 [LANG_SYS_DATE_YEARS_AGO]";
    } elseif ($time - $year11 >= 0) {
        $ret = "10 [LANG_SYS_DATE_YEARS_AGO]";
    } else {
        $ret = date("Y.m.d.", $time);
    }

    return $ret;
}

return; ?>