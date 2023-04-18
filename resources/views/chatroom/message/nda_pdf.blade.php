<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
        @font-face {
            font-family: ipaexg;
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/ipaexg.ttf') }}') format('truetype');
        }
        @font-face {
            font-family: ipaexg;
            font-style: bold;
            font-weight: bold;
            src: url('{{ storage_path('fonts/ipaexg.ttf') }}') format('truetype');
        }
        body {
            font-family: ipaexg !important;
            word-break:break-all;
            word-wrap:break-word;
        } 
    </style>
</head>
<body>
    <h2 style="text-align:center">秘密保持契約書（NDA）</h2>
    {!! $nda_text !!}
</body>
</html>
