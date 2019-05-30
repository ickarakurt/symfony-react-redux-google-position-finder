import React from 'react';
import { Col, Button, Form,  Row  } from 'react-bootstrap';
import axios from 'axios';
import { Redirect, Link } from "react-router-dom";
import SweetAlert from 'sweetalert-react';
import {connect} from "react-redux";
import {  changeLoginStatus } from "../actions/users-action";

class Login extends React.Component {
   
    
    state = {
      username : "",
      password : "",
      showError: false,
      redirect : false,
    }

    usernameChange = (e) => this.setState({username : e.target.value});
    passwordChange = (e) => this.setState({password : e.target.value});

    doLogin = () => {
      axios.post('http://localhost:8000/api/login', {
        username : this.state.username,
        password : this.state.password
      })
      .then(response  => {
        localStorage.setItem('token',response.data.token);
        this.props.changeLoginStatus(true);
        this.setState({ redirect : true });

      })
      .catch(error => {
        this.setState({ showError : true });
      });
    }

    loginError = () => <SweetAlert
    show={this.state.showError}
    title="Error"
    text="Please try again."
    type="error"
    onConfirm={() => this.setState({ showError: false })}
  />
  


    Form = () => {
      return(

<div className="container" style={{ marginTop : '170px' }}>
          
          <Row className="justify-content-md-center p-4 text-center">
          <Col md={5} className="p-5 shadow-lg">
          <h2 className="text-muted mb-4">Login</h2>
          <Form>
      <Form.Group controlId="formBasicEmail" className="shadow-sm">
        <Form.Control type="text" placeholder="Username or Email" onChange={this.usernameChange} />
        
      </Form.Group>

      <Form.Group controlId="formBasicPassword"  className="shadow-sm">
        <Form.Control type="password" placeholder="Your Password" onChange={this.passwordChange} />
      </Form.Group>

      <Button onClick={this.doLogin} className="shadow visteria border-0">
        Login
      </Button>
    </Form>
              <Link className="mt-4" to="/register" >
                  <Button className="shadow border-0 mt-3">
                      Register
                  </Button>
              </Link>
      </Col>
      </Row>
        </div>

      )
    }

    render() {

      return (
                <div>
                  { this.loginError()}
                {
                  this.state.redirect ? <Redirect to="/" /> : this.Form()
                }
                </div>

        )
    }
  }

const mapStateToProps = (state) => {
  return state;
};

const mapDispatchToProps = {
    changeLoginStatus
};

export default connect(mapStateToProps, mapDispatchToProps)(Login);
