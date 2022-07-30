define([
    'jquery',
    'jquery/validate',
    'mage/translate'
 ], function($) {
    'use strict';
 
    return function() {
       // Add a validation method that checks if the name is less than 5 characters.
        $.validator.addMethod(
            'phonevalidation',
            function(value) {
                // if((value.lenght<=15) && (value.lenght >10)){
                    return /^(?=.*[0-9])[- +()0-9]+$/.test(value);
                // }
            },
            $.mage.__('Enter a valid phone number!')
        );
    }
 });