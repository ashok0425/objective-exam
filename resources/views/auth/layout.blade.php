<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <style>
        
* { box-sizing:border-box; }

body {
  background: #eee;
  -webkit-font-smoothing: antialiased;
}

hgroup { 
  text-align:center;
  margin-top: 4em;
}

span {
    font-size: 0.95em;
    font-weight: 600;
    letter-spacing: 0.3em;
    line-height: 24px;
    text-transform: uppercase;
}

/*------------------------------------------------------------------
[ Login Form ]*/

.log-form {
  width: 500px;
  margin: 4em auto;
  padding: 3em 2em 2em 2em;
  background: #fafafa;
  border: 1px solid #ebebeb;
  box-shadow: rgba(0,0,0,0.14902) 0px 1px 1px 0px,rgba(0,0,0,0.09804) 0px 1px 2px 0px;
}

.group { 
  position: relative; 
  margin-bottom: 0px; 
}

.log-input {
  font-size: 18px;
  padding: 10px 10px 10px 5px;
  -webkit-appearance: none;
  display: block;
  background: #fafafa;
  color: #0285f0;
  width: 100%;
  border: none;
  border-radius: 0;
  border-bottom: 1px solid #757575;
}

.log-input:focus { outline: none; }

.log-form a {
    font-size: 9px;
    font-weight: 600;
    letter-spacing: 0.3em;
    line-height: 24px;
    text-transform: uppercase;
    color: #0285f0;
}

.left-align {
    float: left;
    text-align: left;
}

.right-align {
    float: right;
    text-align: right;
}


/*------------------------------------------------------------------
[ Button same code as contact form ]*/

.container-log-btn {
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  padding-top: 50px;
}

.log-form-btn {
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0 20px;
  min-width: 250px;
  height: 50px;
  background-color: transparent;
  border-radius:7px;
  cursor: pointer;

  font-size: 16px;
  color: #000;
  line-height: 1.2;
  text-transform: uppercase;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
  position: relative;
  z-index: 1;
}



.log-form-btn:hover {
  background-color: #0285f0;
}

input[type="text"], input[type="email"],input[type="number"], input[type="password"], textarea, select {
    background: transparent;
    border: none;
    font-family: "Montserrat";
    font-size: 12px;
    font-weight: 400;
    letter-spacing: 0.2em;
    line-height: 24px;
    height: 42px;
    padding-left: 20px;
    padding-right: 20px;
    text-transform: none;
    width: 100%;
}



.text-center{
  text-align: center
}
.alert-danger{
    color: red;
}

.alert-success{
    color: green;
}

    </style>
</head>
<body>
    
   @yield('content')
       

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>

</body>
</html>