MockObject
==========
[![Build Status](https://img.shields.io/travis/kumuwai/mock-object/master.svg)](https://travis-ci.org/kumuwai/mock-object)
[![Coverage Status](https://coveralls.io/repos/kumuwai/mock-object/badge.png?branch=master)](https://coveralls.io/r/kumuwai/mock-object)
[![Quality Score](https://img.shields.io/scrutinizer/g/kumuwai/mock-object.svg)](https://scrutinizer-ci.com/g/kumuwai/mock-object)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE.md)

This provides a mock object that can be used as a test helper


Usage
------

Create a new MockObject using MockObject::mock. 

$mock = MockObject::mock('Class\To\Mock', ['foo','bar']);


Installation
--------------
This is not yet available as a package on packagist, so if you'd like to install it via composer, you'll need to use a vcs repository. Add this to your composer.json file:

    "require": {
        "kumuwai/mock-object": "dev-master"
    },
    "repositories": [
        {
            "type": "vcs",
            "url":  "https://github.com/kumuwai/mock-object.git"
        }
    ],


