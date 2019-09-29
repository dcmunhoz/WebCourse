import '../common/templates/dependencies'
import React from 'react';

import Header from './../common/templates/header'
import Sidebar from './../common/templates/sidebar'
import Footer from './../common/templates/footer'
import Routes from './routes';


export default props => (
    <div className="wrapper">
        <Header />
        <Sidebar />
        <div className='content-wrapper'>
            <Routes />
        </div>
        <Footer />
    </div>    
)