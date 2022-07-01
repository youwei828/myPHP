<?php
namespace controllers;
class Test{
    function index() {
        dd('aa','bb',array(1,23,4,'123'));
    }

    function hello() {
        echo 'this is hello() method';
    }
}