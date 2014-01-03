<?php

$subjects = array();

$subject = new \stdClass();
$subject->name = 'Rudolph the Red-Nosed Reindeer';
$subject->email = 'rudolhp@nortpole.org';
$subject->description = 'some description text';
$subject->age = 33;

$subjects['ok'] = $subject;

$subject = new \stdClass();
$subject->name = null;
$subject->email = 'rudolhp@nortpole.org';
$subject->description = 'some description text';
$subject->age = 33;

$subjects['ko_name'] = $subject;

$subject = new \stdClass();
$subject->name = 'Rudolph the Red-Nosed Reindeer';
$subject->email = 'rudolhp@nortpole';
$subject->description = 'some description text';
$subject->age = 33;

$subjects['ko_email'] = $subject;

$subject = new \stdClass();
$subject->name = 'Rudolph the Red-Nosed Reindeer';
$subject->email = 'rudolhp@nortpole.org';
$subject->description = 'sh';
$subject->age = 33;

$subjects['ko_description_short'] = $subject;

$subject = new \stdClass();
$subject->name = 'Rudolph the Red-Nosed Reindeer';
$subject->email = 'rudolhp@nortpole.org';
$subject->description = 'too long description. too long description. too long description. too long description. too long description. too long description. too long description. too long description. too long description. too long description. too long description. too long description. too long description.';
$subject->age = 33;

$subjects['ko_description_long'] = $subject;

$subject = new \stdClass();
$subject->name = 'Rudolph the Red-Nosed Reindeer';
$subject->email = 'rudolhp@nortpole.org';
$subject->description = null;
$subject->age = 33;

$subjects['ko_description_null'] = $subject;

$subject = new \stdClass();
$subject->name = 'Rudolph the Red-Nosed Reindeer';
$subject->email = 'rudolhp@nortpole.org';
$subject->description = 'some description text';
$subject->age = -1;

$subjects['ko_age_negative'] = $subject;

$subject = new \stdClass();
$subject->name = 'Rudolph the Red-Nosed Reindeer';
$subject->email = 'rudolhp@nortpole.org';
$subject->description = 'some description text';
$subject->age = array('data');

$subjects['ko_age_not_number'] = $subject;

//var_dump($subjects);