<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted'             => 'តម្លៃនៃ :attribute ត្រូវតែទទួលយក.',
    'active_url'           => "តម្លៃនៃ :attribute ជា URL ដែលមិនត្រឹមត្រូវ.",
    'after'                => 'តម្លៃនៃ :attribute ត្រូវតែជាកាលបរិច្ឆេទក្រោយ :date.',
    'after_or_equal'       => 'តម្លៃនៃ :attribute ត្រូវតែជាកាលបរិច្ឆេទក្រោយឬស្មើ :date.',
    'alpha'                => 'តម្លៃនៃ :attribute គួរតែមានតែអក្សរប៉ុណ្ណោះ.',
    'alpha_dash'           => 'តម្លៃនៃ :attribute គួរតែមានតែអក្សរលេខនិងសញ្ញាប៉ុណ្ណោះ.',
    'alpha_num'            => 'តម្លៃនៃ :attribute គួរតែមានតែលេខនិងអក្សរ.',
    'array'                => 'តម្លៃនៃ :attribute ត្រូវតែតារាង.',
    'before'               => 'តម្លៃនៃ :attribute ត្រូវតែជាកាលបរិច្ឆេទមុន :date.',
    'before_or_equal'      => 'តម្លៃនៃ :attribute ត្រូវតែជាកាលបរិច្ឆេទមុនឬស្មើ :date.',
    'between'              => [
        'numeric' => 'តម្លៃនៃ :attribute យ៉ាងហោចណាស់ :min និងមិនច្រើនជាង :max.',
        'file'    => 'ទំហំនៃឯកសារ :attribute យ៉ាងហោចណាស់ :min និងមិនច្រើនជាង :max kilobyte.',
        'string'  => 'តម្លៃនៃឯកសារ :attribute យ៉ាងហោចណាស់ :min និងមិនច្រើនជាង :max តួអក្សរ.',
        'array'   => 'តម្លៃនៃតារាង :attribute យ៉ាងហោចណាស់ :min និងមិនច្រើនជាង :max ធាតុ.',
    ],
    'boolean'              => 'តម្លៃនៃ :attribute ត្រូវតែពិតឬមិនពិត.',
    'confirmed'            => 'តម្លៃនៃបញ្ជាក់បន្ថែម :attribute គឺមិនត្រូវគ្នាទេ.',
    'date'                 => "តម្លៃនៃ :attribute គឺមិនត្រឹមត្រូវជាមួយកាលបរិច្ឆេទទេ.",
    'date_format'          => 'តម្លៃនៃ :attribute មិនត្រឹមត្រូវនឹងទម្រង់ :format.',
    'different'            => 'តម្លៃនៃ :attribute និង :other គឺត្រូវតែខុសគ្នា.',
    'digits'               => 'តម្លៃនៃ :attribute ត្រូវតែមាន :digits ស្ថិតិ.',
    'digits_between'       => 'តម្លៃនៃ :attribute ត្រូវតែមានចន្លោះពី :min និង :max ស្ថិតិ.',
    'dimensions'           => "ទំហំរូបភាព :attribute គឺមិនត្រឹមត្រូវ.",
    'distinct'             => 'តម្លៃនៃ :attribute មានតម្លៃជាន់គ្នា.',
    'email'                => 'តម្លៃនៃ :attribute ត្រូវតែជាអាស័យដ្ឋានអ៊ីម៉ែលត្រឹមត្រូវ.',
    'exists'               => 'តម្លៃនៃ :attribute ជ្រើសរើសមិនត្រឹមត្រូវ.',
    'file'                 => 'តម្លៃនៃ :attribute ត្រូវតែជាឯកសារ.',
    'filled'               => 'តម្លៃនៃ :attribute គឺត្រូវតែបំពេញ.',
    'image'                => 'តម្លៃនៃ :attribute គឺត្រូវតែជារូបភាព.',
    'in'                   => 'តម្លៃនៃ :attribute គឺមិនត្រឹមត្រូវ.',
    'in_array'             => 'តម្លៃនៃ :attribute មិនមាននៅក្នុង :other.',
    'integer'              => 'តម្លៃនៃ :attribute ត្រូវតែជាចំនួនគត់.',
    'ip'                   => 'តម្លៃនៃ :attribute ត្រូវតែជាអាសយដ្ឋាន IP ត្រឹមត្រូវ.',
    'json'                 => 'តម្លៃនៃ :attribute ត្រូវតែជាឯកសារ JSON ត្រឹមត្រូវ.',
    'max'                  => [
        'numeric' => 'តម្លៃ :attribute មិនអាចធំជាង :max.',
        'file'    => 'ទំហំនៃឯកសារ :attribute មិនអាចធំជាង :max kilobyte.',
        'string'  => 'តម្លៃនៃឯកសារ :attribute មិនអាចច្រើនជាង :max តួអក្សរ.',
        'array'   => 'តម្លៃនៃតារាង :attribute មិនអាចច្រើនជាង :max ធាតុ.',
    ],
    'mimes'                => 'តម្លៃនៃ :attribute ត្រូវតែជាឯកសារប្រភេទ : :values.',
    'mimetypes'            => 'តម្លៃនៃ :attribute ត្រូវតែមានជាឯកសារប្រភេទ : :values.',
    'min'                  => [
        'numeric' => 'តម្លៃ :attribute ត្រូវតែធំជាងឬស្មើ :min.',
        'file'    => 'ទំហំនៃឯកសារ :attribute ត្រូវតែមានយ៉ាងហោចណាស់ :min kilobyte.',
        'string'  => 'តម្លៃនៃឯកសារ :attribute ត្រូវតែមានយ៉ាងហោចណាស់ :min តួអក្សរ.',
        'array'   => 'តម្លៃនៃតារាង :attribute ត្រូវតែមានធាតុយ៉ាងហោចណាស់ :min ធាតុ.',
    ],
    'not_in'               => "ចន្លោះនៃ :attribute ជ្រើសរើសមិនត្រឹមត្រូវ.",
    'numeric'              => 'ចន្លោះនៃ :attribute គឺត្រូវតែមានលេខ.',
    'present'              => 'ចន្លោះនៃ :attribute គឺត្រូវតែមាន.',
    'regex'                => 'ទម្រង់នៃចន្លោះ :attribute គឺមិនត្រឹមត្រូវ.',
    'required'             => 'ចន្លោះនៃ :attribute គឺចាំបាច់ត្រូវតែមាន.',
    'required_if'          => 'ចន្លោះនៃ :attribute គឺចាំបាច់នៅពេលដែលតម្លៃនៃតម្លៃ :other គឺតម្លៃ :value.',
    'required_unless'      => 'ចន្លោះនៃ :attribute គឺចាំបាច់លុះត្រាតែ :other គឺ :values.',
    'required_with'        => 'ចន្លោះនៃ :attribute គឺចាំបាច់នៅពេល :values ពេលបច្ចប្បន្ន.',
    'required_with_all'    => 'ចន្លោះនៃ :attribute គឺចាំបាច់នៅពេល :values ពេលបច្ចប្បន្ន.',
    'required_without'     => "ចន្លោះនៃ :attribute គឺចាំបាច់នៅពេល :values នៃពេលបច្ចប្បន្ន.",
    'required_without_all' => "ចន្លោះនៃ :attribute តម្រូវអោយមាននៅពេលមានគ្មានតម្លៃនៃ :values បច្ចប្បន្ន.",
    'same'                 => 'តម្លៃនៃចន្លោះ :attribute ត្រូវតែដូចគ្នានឹង :other',
    'size'                 => [
        'numeric' => 'តម្លៃនៃ :attribute ត្រូវតែមាន :size.',
        'file'    => 'ទំហំនៃឯកសារ :attribute ត្រូវតែមាន :size kilobyte.',
        'string'  => 'អត្ថបទ :attribute ត្រូវតែមាន :size តួអក្សរ.',
        'array'   => 'តារាង :attribute ត្រូវតែមាន :size ធាតុ.',
    ],
    'string'               => 'ចន្លោះនៃ :attribute គឺត្រូវតែជាតួអក្សរ.',
    'timezone'             => 'ចន្លោះនៃ :attribute គឺត្រូវតែមានតំបន់ពេលវេលាត្រឹមត្រូវ.',
    'unique'               => 'តម្លៃចន្លោះនៃ :attribute គឺត្រូវបានប្រើប្រាស់.',
    'uploaded'             => "ឯកសារនៅក្នុងចន្លោះ :attribute មិនអាចទាញយកបានទេ.",
    'url'                  => "ទម្រង់នៃ  URL :attribute មិនត្រឹមត្រូវ.",

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

    'custom' => [
        'can_be_author' => [
            'accepted' => "អ្នកនិពន្ធដែលបានជ្រើសរើសមិនត្រឹមត្រូវ.",
        ],
    ],

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

    'attributes'           => [
        'name'                  => 'ឈ្មោះ',
        'username'              => 'ឈ្មោះអ្នកប្រើប្រាស់',
        'email'                 => 'អាសយដ្ឋានអ៊ីមែល',
        'first_name'            => 'នាមខ្លួន',
        'last_name'             => 'នាមត្រកូល',
        'password'              => 'លេខកូដសម្ថាត់',
        'password_confirmation' => 'បញ្ជាក់បន្ថែមលេខកូដសម្ងាត់',
        'city'                  => 'ទីក្រុង',
        'country'               => 'ប្រទេស',
        'address'               => 'អាស័យដ្ឋាន',
        'phone'                 => 'ទូរស័ព្ទ',
        'mobile'                => 'ទូរស័ព្ទដៃ',
        'age'                   => 'អាយុ',
        'sex'                   => 'ភេទ',
        'gender'                => 'ភេទ',
        'day'                   => 'ថ្ងៃ',
        'month'                 => 'ខែ',
        'year'                  => 'ឆ្នាំ',
        'hour'                  => 'ម៉ោង',
        'minute'                => 'នាទី',
        'second'                => 'វិនាទី',
        'title'                 => 'ចំណងជើង',
        'content'               => 'មាតិកា',
        'description'           => 'ការបរិយាយ',
        'excerpt'               => 'ដកស្រង់',
        'date'                  => 'កាលបរិច្ឆេទ',
        'time'                  => 'ពេលវេលា',
        'available'             => 'ដែលមាន',
        'size'                  => 'ទំហំ',
        'posted_at'             => 'អត្ថបទ',
        'author_id'             => 'អ្នកនិពន្ធ',
    ],

    'errors' => ":count កំហុស :"

];
