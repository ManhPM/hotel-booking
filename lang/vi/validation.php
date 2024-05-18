<?php

return [

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

    'accepted' => 'Trường :attribute phải được chấp nhận.',
    'accepted_if' => 'Trường :attribute phải được chấp nhận khi :other là :value.',
    'active_url' => 'Trường :attribute không phải là URL hợp lệ.',
    'after' => 'Trường :attribute phải là ngày sau :date.',
    'after_or_equal' => 'Trường :attribute phải là ngày sau hoặc bằng :date.',
    'alpha' => 'Trường :attribute chỉ được chứa các chữ cái.',
    'alpha_dash' => 'Trường :attribute chỉ được chứa chữ cái, số, dấu gạch ngang và dấu gạch dưới.',
    'alpha_num' => 'Trường :attribute chỉ được chứa chữ cái và số.',
    'array' => 'Trường :attribute phải là một mảng.',
    'ascii' => 'Trường :attribute chỉ được chứa các ký tự và ký hiệu chữ và số một byte.',
    'before' => 'Trường :attribute phải là ngày trước :date.',
    'before_or_equal' => 'Trường :attribute phải là ngày trước hoặc bằng :date.',
    'between' => [
        'array' => 'Trường :attribute phải có giữa các mục :min và :max.',
        'file' => 'Trường :attribute phải nằm trong khoảng :min và :max kilobyte.',
        'numeric' => 'Trường :attribute phải nằm trong khoảng :min và :max.',
        'string' => 'Trường :attribute phải nằm trong khoảng :min và :max ký tự.',
    ],
    'boolean' => 'Trường :attribute phải có giá trị true hoặc false.',
    'confirmed' => 'Trường :attribute xác nhận không giống.',
    'current_password' => 'Mật khẩu không chính xác.',
    'date' => 'Trường :attribute không phải là ngày hợp lệ.',
    'date_equals' => 'Trường :attribute phải là một ngày bằng :date.',
    'date_format' => 'Trường :attribute không phù hợp với định dạng :format.',
    'decimal' => 'Trường :attribute phải là :decimal chữ số thập phân.',
    'declined' => 'Trường :attribute phải bị từ chối.',
    'declined_if' => 'Trường :attribute phải bị từ chối khi :other là :value.',
    'different' => 'Trường :attribute và :other phải khác nhau.',
    'digits' => 'Trường :attribute phải là :digits kí tự.',
    'digits_between' => 'Trường :attribute phải có từ :min đến :max kí tự.',
    'dimensions' => 'Trường :attribute có kích thước hình ảnh không hợp lệ',
    'distinct' => 'Trường :attribute có giá trị trùng lặp.',
    'doesnt_end_with' => 'Trường :attribute không được kết thúc bằng một trong các giá trị sau: :values.',
    'doesnt_start_with' => 'Trường :attribute không được bắt đầu bằng một trong các giá trị sau: :values.',
    'email' => 'Trường :attribute phải la một địa chỉ email hợp lệ.',
    'ends_with' => 'Trường :attribute phải kết thúc bằng một trong các giá trị sau: :values.',
    'enum' => 'Trường được chọn :attribute không hợp lệ.',
    'exists' => 'Trường được chọn :attribute không hợp lệ.',
    'file' => 'Trường :attribute phải là tệp tin.',
    'filled' => 'Trường :attribute field phải có một giá trị.',
    'gt' => [
        'array' => 'Trường :attribute phải có hơn :value items.',
        'file' => 'Trường :attribute phải có hơn :value kilobytes.',
        'numeric' => 'Trường :attribute phải có hơn :value.',
        'string' => 'Trường :attribute phải có hơn :value kí tự.',
    ],
    'gte' => [
        'array' => 'Trường :attribute phải có :value items hoặc hơn.',
        'file' => 'Trường :attribute phải có hơn hoặc bằng :value kilobytes.',
        'numeric' => 'Trường :attribute phải có hơn hoặc bằng :value.',
        'string' => 'Trường :attribute phải có hơn hoặc bằng :value kí tự.',
    ],
    'image' => 'Trường :attribute phải là hình ảnh.',
    'in' => 'Trường được chọn :attribute không hợp lệ.',
    'in_array' => 'Trường :attribute không hợp lệ in :other.',
    'integer' => 'Trường :attribute phải là số nguyên.',
    'ip' => 'Trường :attribute phải là IP Address hợp lệ.',
    'ipv4' => 'Trường :attribute phải là IPv4 Address hợp lệ.',
    'ipv6' => 'Trường :attribute phải là IPv6 Address hợp lệ.',
    'json' => 'Trường :attribute phải là chuỗi JSON hợp lệ.',
    'lowercase' => 'Trường :attribute phải viết thường.',
    'lt' => [
        'array' => 'Trường :attribute phải có ít hơn :value items.',
        'file' => 'Trường :attribute must be ít hơn :value kilobytes.',
        'numeric' => 'Trường :attribute must be ít hơn :value.',
        'string' => 'Trường :attribute must be ít hơn :value kí tự.',
    ],
    'lte' => [
        'array' => 'Trường :attribute không được có nhiều hơn :value items.',
        'file' => 'Trường :attribute phải ít hơn hoặc bằng :value kilobytes.',
        'numeric' => 'Trường :attribute phải ít hơn hoặc bằng :value.',
        'string' => 'Trường :attribute phải ít hơn hoặc bằng :value kí tự.',
    ],
    'mac_address' => 'Trường :attribute phải là MAC Address hợp lệ.',
    'max' => [
        'array' => 'Trường :attribute không được có nhiều hơn :max items.',
        'file' => 'Trường :attribute must not be greater than :max kilobytes.',
        'numeric' => 'Trường :attribute must not be greater than :max.',
        'string' => 'Trường :attribute must not be greater than :max kí tự.',
    ],
    'max_digits' => 'Trường :attribute không được có nhiều hơn :max digits.',
    'mimes' => 'Trường :attribute phải là tập tin loại: :values.',
    'mimetypes' => 'Trường :attribute phải là tập tin loại: :values.',
    'min' => [
        'array' => 'Trường :attribute phải có ít nhất :min items.',
        'file' => 'Trường :attribute ít nhất phải là :min kilobytes.',
        'numeric' => 'Trường :attribute ít nhất phải là :min.',
        'string' => 'Trường :attribute ít nhất phải là :min kí tự.',
    ],
    'min_digits' => 'Trường :attribute phải có ít nhất :min digits.',
    'missing' => 'Trường :attribute phải bị thiếu.',
    'missing_if' => 'Trường :attribute phải bị thiếu khi :other là :value.',
    'missing_unless' => 'Trường :attribute phải bị thiếu unless :other là :value.',
    'missing_with' => 'Trường :attribute phải bị thiếu khi :values đã có.',
    'missing_with_all' => 'Trường :attribute phải bị thiếu khi :values đã có.',
    'multiple_of' => 'Trường :attribute phải là bội số của :value.',
    'not_in' => 'Trường được chọn :attribute không hợp lệ.',
    'not_regex' => 'Trường :attribute format không hợp lệ.',
    'numeric' => 'Trường :attribute phải là số.',
    'password' => [
        'letters' => 'Trường :attribute phải chứa ít nhất một chữ cái.',
        'mixed' => 'Trường :attribute phải có ít nhất một chữ hoa và một chữ thường.',
        'numbers' => 'Trường :attribute phải chứa ít nhất một số.',
        'symbols' => 'Trường :attribute phải chứa ít nhất một ký tự đặc biệt.',
        'uncompromised' => 'Thuộc tính :attribute đã cho đã xuất hiện trong một vụ rò rỉ dữ liệu. Vui lòng chọn một :attribute khác.',
    ],
    'present' => 'Trường attribute phải tồn tại.',
    'prohibited' => 'Không được phép sử dụng :attribute.',
    'prohibited_if' => 'Trường attribute bị cấm khi :other là :value.',
    'prohibited_unless' => 'Trường attribute bị cấm trừ khi :other nằm trong :values.',
    'prohibits' => 'Trường :attribute cấm :other từ việc tồn tại.',
    'regex' => 'Định dạng của :attribute không hợp lệ.',
    'required' => 'Trường :attribute không được để trống.',
    'required_array_keys' => 'Trường attribute phải chứa các mục: :values.',
    'required_if' => 'Trường attribute là bắt buộc khi :other là :value.',
    'required_if_accepted' => 'Trường attribute là bắt buộc khi :other được chấp nhận.',
    'required_unless' => 'Trường attribute là bắt buộc trừ khi :other nằm trong :values.',
    'required_with' => 'Trường attribute là bắt buộc khi :values tồn tại.',
    'required_with_all' => 'Trường attribute là bắt buộc khi tất cả :values tồn tại.',
    'required_without' => 'Trường attribute là bắt buộc khi :values không tồn tại.',
    'required_without_all' => 'Trường attribute là bắt buộc khi không có :values nào tồn tại.',
    'same' => 'Trường attribute và :other phải khớp.',
    'size' => [
        'array' => 'Trường attribute phải chứa :size mục.',
        'file' => 'Trường attribute phải là :size kilobyte.',
        'numeric' => 'Trường attribute phải là :size.',
        'string' => 'Trường attribute phải là :size ký tự.',
    ],
    'starts_with' => 'Trường attribute phải bắt đầu bằng một trong những giá trị sau: :values.',
    'string' => 'Trường attribute phải là một chuỗi.',
    'timezone' => 'Trường attribute phải là múi giờ hợp lệ.',
    'unique' => 'Trường attribute đã được sử dụng.',
    'uploaded' => 'Tải lên :attribute thất bại.',
    'uppercase' => 'Trường attribute phải là chữ hoa.',
    'url' => 'Trường attribute phải là URL hợp lệ.',
    'ulid' => 'Trường attribute phải là ULID hợp lệ.',
    'uuid' => 'Trường attribute phải là UUID hợp lệ.',


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
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
