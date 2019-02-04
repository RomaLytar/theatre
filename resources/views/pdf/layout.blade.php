<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Order Details</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
    <style>
        .pdf-print {
            margin: 20px;
            border: 1px solid #666;
            padding: 15px 15px 0;
            font: 18px/24px "Times New Roman", serif;
            -webkit-print-color-adjust:exact;
        }

        .pdf-print .barcode {
            margin: 0 0 0 30px;
            background: #ccc;
            height: 50px;
            width: 300px;
        }

        .header {
            display: flex;
            align-items: flex-start;
            justify-content: space-around;
            margin: 0 0 30px;
        }

        .header .logo {
            width: 200px;
            height: auto;
            text-align: center;
            font-size: 16px;
            font-weight: 500;
        }

        .header img {
            width: 100%;
            height: auto;
            display: block;
            margin: 0 0 10px;
        }

        .info-wrap {
            display: flex;
            margin: 0 0 20px;
        }

        .info {
            flex-grow: 1;
            padding: 0 0 0 10px;
        }

        .info p {
            margin: 0;
        }

        .info-title {
            font-size: 22px;
            line-height: 30px;
            background: #333;
            color: #fff;
            margin: 0 0 10px -10px;
            font-weight: 400;
            padding: 10px 20px;
        }

        .contacts {
            flex-shrink: 0;
            font-size: 24px;
            line-height: 30px;
            color: #000;
            font-weight: 700;
            min-width: 250px;
        }

        .contacts p {
            margin: 0;
            padding: 0 30px;
            height: 100px;
            display: flex;
            align-items: center;
        }

        .contacts-title {
            padding: 10px 30px;
            line-height: 29px;
            margin: 0;
            font-size: 100%;
            font-weight: 700;
            border-bottom: 1px solid #333;
        }

        .rules {
            padding: 0 0 0 10px;
            margin: 0 0 100px;
        }

        .rules-header {
            color: #999;
            padding: 0 0 0 10px;
            font-size: 22px;
            margin: 0 0 10px;
        }

        .rules-header p {
            margin: 0;
        }

        .rules-header small {
            display: block;
            font-size: 70%;
        }

        .rules-title {
            margin: 0 0 10px;
            font-weight: 700;
            font-size: 22px;
        }

        .rules-list {
            list-style-position: inside;
            padding: 0;
        }

        .ticket {

        }

        .ticket-main {
            border: 1px solid #000;
            border-bottom-style: dashed;
            padding: 10px 10px 20px;
        }

        .ticket-main header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0 0 30px;
        }

        .ticket-main .logo {
            width: 150px;
            margin-right: auto;
        }

        .ticket-main .logo img {
            width: 100%;
            height: auto;
            display: block;
        }

        .ticket-info {
            display: flex;
            align-items: flex-start;
            margin: 0 0 40px;
        }

        .ticket-left {
            width: 50%;
        }

        .ticket-name {
            font-size: 24px;
            line-height: 1.4;
            font-weight: 700;
            margin: 0 0 10px;
        }

        .ticket-date {
            display: block;
            font-style: italic;
            margin: 0 0 10px;
        }

        .ticket-hall {
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 5px;
        }

        .ticket-place {
            font-weight: 700;
            margin: 0;
        }

        .ticket-right {
            width: 50%;
            font-size: 20px;
        }

        .ticket-right span {
            font-weight: 700;
        }

        .ticket-cost {
            margin: 0 0 10px;
        }

        .ticket-buyer {
            margin: 0;
        }

        .ticket-main footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 20px;
        }

        .ticket-number {
            margin: 0;
        }

        .ticket-number span {
            font-size: 24px;
            font-weight: 700;
            color: #666;
        }

        .ticket-site {
            text-decoration: underline;
            font-size: 100%;
        }

        .ticket-spine {
            border: 1px solid #000;
            border-top: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 30px;
        }

        .ticket-spine .barcode {
            margin: 0 30px 0 0;
        }

        .copyright {
            margin: 30px 0;
            text-align: center;
        }
    </style>
</head>
<body>
@yield('content')
</body>
</html>
