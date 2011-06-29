<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>P&aacute;gina de Testes</title>
    <style type="text/css">
    .breadcrumb {
        list-style: none;
        overflow: hidden;
        font: 18px Helvetica, Arial, Sans-Serif;
    }
    .breadcrumb li {
        float: left;
    }
    .breadcrumb li a {
        color: white;
        text-decoration: none;
        padding: 10px 0 10px 65px;
        background: brown;                   /* fallback color */
        background: hsla(34,85%,35%,1);
        position: relative;
        display: block;
        float: left;
    }
    .breadcrumb li a:after {
        content: " ";
        display: block;
        width: 0;
        height: 0;
        border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
        border-bottom: 50px solid transparent;
        border-left: 30px solid hsla(34,85%,35%,1);
        position: absolute;
        top: 50%;
        margin-top: -50px;
        left: 100%;
        z-index: 2;
    }
    .breadcrumb li a:before {
        content: " ";
        display: block;
        width: 0;
        height: 0;
        border-top: 50px solid transparent;
        border-bottom: 50px solid transparent;
        border-left: 30px solid white;
        position: absolute;
        top: 50%;
        margin-top: -50px;
        margin-left: 1px;
        left: 100%;
        z-index: 1;
    }
    .breadcrumb li:first-child a {
        padding-left: 10px;
    }
    .breadcrumb li:nth-child(2) a       { background:        hsla(34,85%,45%,1); }
    .breadcrumb li:nth-child(2) a:after { border-left-color: hsla(34,85%,45%,1); }
    .breadcrumb li:nth-child(3) a       { background:        hsla(34,85%,55%,1); }
    .breadcrumb li:nth-child(3) a:after { border-left-color: hsla(34,85%,55%,1); }
    .breadcrumb li:nth-child(4) a       { background:        hsla(34,85%,65%,1); }
    .breadcrumb li:nth-child(4) a:after { border-left-color: hsla(34,85%,65%,1); }
    .breadcrumb li:nth-child(5) a       { background:        hsla(34,85%,75%,1); }
    .breadcrumb li:nth-child(5) a:after { border-left-color: hsla(34,85%,75%,1); }
    .breadcrumb li:last-child a {
        background: transparent !important;
        color: black;
        pointer-events: none;
        cursor: default;
    }
    .breadcrumb li a:hover { background: hsla(34,85%,25%,1); }
    .breadcrumb li a:hover:after { border-left-color: hsla(34,85%,25%,1) !important; }
    </style>
</head>

<body>

<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Vehicles</a></li>
    <li><a href="#">Vans</a></li>
    <li><a href="#">Camper Vans</a></li>
    <li><a href="#">1989 VW Westfalia Vanagon</a></li>
</ul>

</body>
</html>