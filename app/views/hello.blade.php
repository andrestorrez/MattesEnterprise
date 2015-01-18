@extends('layouts.main')

@section('content')

      <style type="text/css">
        div.coverImg{
          background: url('/img/cover.jpg');
          background-size: cover;
          margin-bottom: 0;
        }

        .white{
          background-color:rgba(255, 255, 255, 0.75);
          border-radius:3px;
        }

        h1.title{
           
            color: #149c82;
            text-shadow: 5px 5px 15px #000;
        }

        @media (min-width: 900px){
          h1.title{
            
            font-size: 600%;
          }
          img.img-thumbnail{
            width: 40%;
          }
        }

         @media (max-width: 900px){
          h1.title{
            
            //font-size: 400%;
          }
          img.img-thumbnail{
            width: 20%;
          }
        }
      </style>
      <div class="jumbotron coverImg">
        
        <div class="row" align="center">
        <br>
        <div class="col-md-5">
        <h1 class='title' align="center">Bienvenida</h1>
        <img class="img-thumbnail" src="/img/IMG-20140327-WA0001.jpg" style="opacity:0.75">
         </div>   
           
            
@if (!Auth::check())
            <div class='col-md-3'></div>

            <div class="col-md-4 container white" >

           

            {{Form::open(array('method'=>'post','route'=>'login','class'=>'form-sigin','role'=>'form'))}}
                <h2 class="form-signin-heading">Por favor ingrese </h2>
                 @if (Session::has('login_errors'))
                 <br>
                <div style="opacity:0.8; border-radius:3px;" class="alert alert-danger">
                <p><small>Usuario o contrasenia invalidos.</small></p>
                    
                </div>
            @endif
                <br>
                <div class="form-group">
                {{Form::text('username','',array('class'=>'form-control','placeholder'=>'Nombre de usuario','required','autofocus','id'=>'username'))}}
                </div>
                {{Form::password('password',array('class'=>'form-control','placeholder'=>'Contraseña','required','id'=>'password'))}}
                <br>
                <label class="checkbox">
                  <input type="checkbox" value="remember-me"> Recordarme
                </label>
                <br>
                <button class="btn btn-md btn-primary btn-block" type="submit">Entrar</button>
              {{Form::close()}}
            </div>
@endif
          </div>
          <br>
      </div>
@stop
