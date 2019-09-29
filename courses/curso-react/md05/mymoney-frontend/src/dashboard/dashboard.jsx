import React from 'react';

import ContentHeader from '../common/templates/contentHeader';
import Content from '../common/templates/content';
import ValueBox from '../common/widget/valueBox'
import Row from '../common/layout/row';

export default class Dashboard extends React.Component {
    render () {
        return (
            <div>
                <ContentHeader title="Dashboard" small="Versão 1.0"/>
                <Row>
                    <Content>
                        <ValueBox cols='12 4' color='green' icon='bank' value='R$ 10' text='Total de Crédito' />
                        <ValueBox cols='12 4' color='red' icon='credit-card' value='R$ 10' text='Total de Débitos' />
                        <ValueBox cols='12 4' color='blue' icon='money' value='R$ 0' text='Valor Consolidado' />
                    </Content>
                </Row>    
            </div>
        )
    }
}