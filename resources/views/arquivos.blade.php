@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div id="abcd" english="<strong> Files </strong>" class="card-header"><strong> Arquivos </strong></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <ul>
                            <?php
                                $dados = Auth::user()->where('id', '=', Auth::user()->id)->join('grupousuario', 'users.idGrupo', '=', 'grupousuario.idGrupo')->get(); 

                                foreach ($dados as $dado){
                                    $nomeGrupo = $dado->nome;
                                }

                                if ($nomeGrupo == "Usuário" || $nomeGrupo == "Visitante"){
                                    foreach ($dadosDb as $valor) {
                                        echo "<li><a href='abrir/" . $valor->nome . "' target='_blank'>" . $valor->nomeExibicao . "</a> </li>";
                                    }
                                } else {
                                    foreach ($dadosDb as $valor) {
                                        echo "<li><a href='abrir/" . $valor->nome . "' target='_blank'>" . $valor->nomeExibicao . "</a> <a href='excluir/' style='float:right'>     Excluir</a></li>";
                                    }
                                }
                                
                                
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    
@endsection
