<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Kantin Bersih</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div id="main" class="bg-center bg-cover w-full h-screen p-14 box-border">
        <div id="login" class="m-auto w-fit h-fit rounded-3xl bg-white pt-16 px-5 pb-16 shadow-lg">
            <div id="logo" class="m-auto w-20 h-20"></div>
            <h2 class="pt-10 px-5 text-[#190050] text-center font-sans font-black text-3xl tracking-widest leading-3">
                WELCOME
            </h2>
            <h3 class="pl-7 pr-5 text-center text-[#190050] text-xs font-sans font-light tracking-[6px] leading-10">
                KANTIN BERSIH
            </h3>

            <form method="POST" action="">
                @csrf

                <div id="input" class="relative">
                    <i class="fa-solid fa-user absolute top-8 pl-6 text-primary"></i>
                    <input type="text" name="username" placeholder="Enter Username Here" required autocomplete="off"
                        class="relative w-64 h-8 mt-6 ml-14 mr-5 px-0.5 bg-transparent border-0 border-b border-solid border-gray-300 focus:border-primary font-sans text-base placeholder:text-sm tracking-wide focus:ring-0 transition-colors">
                </div>
                <div id="input" class="relative">
                    <i class="fa-solid fa-lock absolute top-8 pl-6 text-primary"></i>
                    <input type="password" name="password" placeholder="Enter Password Here" required
                        class="relative w-64 h-8 mt-6 ml-14 mr-5 px-0.5 bg-transparent border-0 border-b border-solid border-gray-300 focus:border-primary font-sans text-base placeholder:text-sm tracking-wide focus:ring-0 transition-colors">
                </div>

                <button type="submit"
                    class="w-72 h-10 mt-8 mx-5 bg-primary border-none font-sans font-medium text-xl tracking-wide rounded-lg text-white hover:bg-orange-700 transition-all duration-300">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
