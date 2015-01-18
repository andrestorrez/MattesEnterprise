<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted"         => "El :attribute debe ser aceptado.",
    "active_url"       => "El :attribute no es un URL válido.",
    "after"            => "El :attribute debe ser una fecha luego de :date.",
    "alpha"            => "El :attribute sólo puede contener letras.",
    "alpha_dash"       => "El :attribute puede contener letras, números y guiones solamente.",
    "alpha_num"        => "El :attribute puede contener sólo letras y números.",
    "array"            => "El :attribute debe ser un arreglo.",
    "before"           => "El :attribute debe ser una fecha antes de :date.",
    "between"          => array(
        "numeric" => "El :attribute debe estar entre :min y :max.",
        "file"    => "El :attribute debe tener entre :min y :max kilobytes.",
        "string"  => "El :attribute debe tener entre :min y :max caracteres.",
        "array"   => "El :attribute debe tener entre :min and :max objetos.",
    ),
    "confirmed"        => "La confirmación de :attribute no coincide.",
    "date"             => "El :attribute no es una fecha válida.",
    "date_format"      => "El :attribute no coincide con el formato :format.",
    "different"        => "El :attribute y :other deben ser diferentes.",
    "digits"           => "El :attribute debe tener :digits dígitos.",
    "digits_between"   => "El :attribute debe tener entre :min y :max dígitos.",
    "email"            => "El formato de :attribute es inválido.",
    "exists"           => "El :attribute seleccionado es inválido.",
    "image"            => "El :attribute debe ser una imagen.",
    "in"               => "El :attribute seleccionado es inválido.",
    "integer"          => "El :attribute debe ser un entero.",
    "ip"               => "El :attribute debe ser una IP válida.",
    "max"              => array(
        "numeric" => "El :attribute no puede ser mayor a :max.",
        "file"    => "El :attribute no puede ser más grande de :max kilobytes.",
        "string"  => "El :attribute no puede ser más grande de :max characters.",
        "array"   => "El :attribute no puede tener más de :max objetos.",
    ),
    "mimes"            => "El :attribute debe ser un archivo de tipo: :values.",
    "min"              => array(
        "numeric" => "El :attribute debe ser al menos :min.",
        "file"    => "El :attribute debe tener al menos :min kilobytes.",
        "string"  => "El :attribute debe tener al menos :min characters.",
        "array"   => "El :attribute debe tener al menos :min objetos.",
    ),
    "not_in"           => "El :attribute seleccionado es inválido.",
    "numeric"          => "El :attribute debe ser un número.",
    "regex"            => "El formato de :attribute es inválido.",
    "required"         => "El :attribute es requerido.",
    "required_if"      => "El :attribute es requerido cuando :other es :value.",
    "required_with"    => "El :attribute es requerido cuando :values está presente.",
    "required_without" => "El :attribute es requerido cuando :values no está presente.",
    "same"             => "El :attribute y :other deben coincidir.",
    "size"             => array(
        "numeric" => "El :attribute debe ser :size.",
        "file"    => "El :attribute debe tener :size kilobytes.",
        "string"  => "El :attribute debe tener :size caracteres.",
        "array"   => "El :attribute debe contener :size objetos.",
    ),
    "unique"           => "El :attribute ya ha sido utilizado.",
    "url"              => "El formato de :attribute es inválido.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => array(),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => array(),

);
