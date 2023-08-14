<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
    <script src="https://unpkg.com/vue-multiselect@2.1.6"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.6/dist/vue-multiselect.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *::-webkit-scrollbar{
            width: 2px;
        }
        *::-webkit-scrollbar-track{
            background: #f1f1f1;
        }
        *::-webkit-scrollbar-thumb{
            background: #9e9797;
            border-radius: 20px;
        }
        *::-webkit-scrollbar-thumb:hover{
            background: #ff4c30;
        }
      </style>
</head>
<body>
    <div id="app"  class="antialiased font-Poppins">
        <router-view></router-view>
    </div>
</body>
</html>