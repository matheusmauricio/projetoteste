@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <?php 
                            $dados = Auth::user()->where('id', '=', Auth::user()->id)->join('grupousuario', 'users.idGrupo', '=', 'grupousuario.idGrupo')->get(); 
                            
                            foreach ($dados as $dado){
                                $nomeExibicao = $dado->nome;
                            }
                        ?>
                        <p id="ab" english="Welcome {{ Auth::user()->name }}, your access level is <strong> {{ $nomeExibicao }} </strong> !">Bem vindo(a) {{ Auth::user()->name }}, seu nível de acesso é <strong> {{ $nomeExibicao }} </strong>! </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Upload de Arquivos</div>

                    <div class="card-body">
                        <p id="abc" english="Upload your files here"> Faça o Upload de seus arquivos! </p>
                        <form action="upload" id="upload" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token()}}">  
                            <input type="file" name="file[]" required> <br />
                            <input type="text" name="nomeExibicao" id="nomeExibicao" placeholder="Nome para exibição" size="60" required> <br />
                            <input type="submit">
                        </form>
                    </div>
                </div>
                @if(session()->has('message'))
                <!-- <script>
                    decisao = confirm("Arquivo já existente, deseja substituí-lo?");
                    
                    if (decisao == true){
                        
                    }

                </script> -->
                    <div class="col-md-8 alert alert-warning" style="font-size:20px">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    

@endsection

