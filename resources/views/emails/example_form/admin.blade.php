{{ $form_data['name'] }} 様より下記の内容のお問い合わせがありました

==============================
お問い合わせ内容
==============================
■お名前:
{{ $form_data['name'] }}
■フリガナ:
{{ $form_data['kana_name'] }}
■性別:
{{ $form_data['sex_id'] }}
■誕生日:
{{ $form_data['birthday_year'] }}年{{ $form_data['birthday_month'] }}月{{ $form_data['birthday_day'] }}日
■メールアドレス:
{{ $form_data['email'] }}
■希望勤務地:
{{ $form_data['job_prefecture_id'] }}
■希望職種:
{{ $form_data['job_type_id'] }}
■電話番号:
{{ $form_data['phone'] }}
■お問い合わせ内容:
{{ $form_data['body'] }}
------------------------------