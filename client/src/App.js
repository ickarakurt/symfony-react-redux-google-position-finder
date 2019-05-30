import React from 'react';
import './App.css';
import Login from './pages/Login';
import Home from './pages/Home';
import Register from './pages/Register';
import Logout from './pages/Logout';
import Project from './pages/Project';
import '../node_modules/sweetalert/dist/sweetalert.css';

import { BrowserRouter as Router, Route } from "react-router-dom";
import {connect} from 'react-redux';

class App extends React.Component {

  render(){

    return (
    <Router>

    <div className="App">
   
    <Route path="/" exact component={Home} />
    <Route path="/project/:website" exact component={Project} />
    <Route path="/login/"  component={Login} />
    <Route path="/register/"  component={Register} />
    <Route path="/logout" component={Logout} />

    </div>
    </Router>

  );
}
}
const mapStateToProps = (state) => {
  return state
};

export default connect(mapStateToProps())(App);
