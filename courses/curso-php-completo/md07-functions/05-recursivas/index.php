<?php

$hierarquia = array(
    array(
        'nome_cargo'=>'CEO',
        'subordinados'=>array(
            //Inicio: Diretor Comercial
            array(
                'nome_cargo'=>'Diretor Comercial',
                'subordinados'=>array(
                    //Inicio: Gerente de Vendas
                    array(
                        'nome_cargo'=>'Gerente de Vendas'
                    )
                    //Inicio: Gerente de Vendas
                )            
            ),
            //Fim: Diretor Comercial

            //Inicio: Diretor Financeiro
            array(
                'nome_cargo'=>'Diretor Financeiro',
                'subordinados'=>array(
                    //Inicio: Gerente de Contas a Pagar
                    array(
                        'nome_cargo'=>'Gerente de contas a pagar',
                        'subordinados'=>array(
                            //Inicio: Supervisor de pagamentos
                            array(
                                'nome_cargo'=>'Supervisor de Pagamentos'
                            )   
                            //Fim: Supervisor de pagamentos
                        )
                    ),
                    //Fim: Gerente de Contas a Pagar

                    //Inicio: Gerente de Compras
                    array(
                        'nome_cargo'=>'Gerente de Compras',
                        'subordinados'=>array(
                            //Inicio: Supervisor Suprimentos
                            array(
                                'nome_cargo'=>'Supervisor Suprimentos',
                                'subordinados'=>array(
                                    array(
                                        'nome_cargo'=>'Funcionario'
                                    )
                                )
                            )
                            
                            //Fim: Supervisor Suprimentos
                        )
                    )
                    //Fim: Gerente de Compras
                )
            )
            //Fim: Diretor Financeiro
        )
    )
);


function exibe($cargos):string{

    $html = '<ul>';

        foreach($cargos as $cargo){

            $html .= "<li>";

            $html .= $cargo['nome_cargo'];
            
            if(isset($cargo['subordinados']) && count($cargo['subordinados'])){

                $html .= exibe($cargo['subordinados']);

            }

            $html .= "</li>";

        }

    $html .= '</ul>';

    return $html;
}

echo exibe($hierarquia);

?>