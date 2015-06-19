Serbian_Variants
===================

`Serbian_Variants` is a PHP class used to get all variants of a string in Serbian language. For example, string "Ђоковић" can also be written as "Đoković", "Djoković", "Djokovic", or some variation of those.

Using
--------

Call class with string you want to get variant of.

`$object = new Serbian_Variants( 'djokovic' );`

You will get all variants in an array with `variants` property of object.

`$object->variants;`

There is also original string in a `original_term` property.

`$object->original_term;`