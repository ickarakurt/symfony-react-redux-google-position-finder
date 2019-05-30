import React from 'react';
import { Col, Button, Form,  Row  } from 'react-bootstrap';
import axios from 'axios';
import SweetAlert from 'sweetalert-react';
import { Loader } from 'react-feather';
import { Redirect } from "react-router-dom";


  class Register extends React.Component {
   
    state = {
      username : "",
      email : "",
      password : "",
      rePassword: "",
      error: "",
      showError: false,
      showSuccess : false,
      btnDisabled: false
    }

    usernameChange = (e) => this.setState({username : e.target.value});
    emailChange = (e) => this.setState({email : e.target.value});
    passwordChange = (e) => this.setState({password : e.target.value});
    rePasswordChange = (e) => this.setState({rePassword  : e.target.value});


    doRegister = () => {
      this.setState({show : true, btnDisabled : true, error : ""});
      axios.post('http://localhost:8000/api/register', {
        username : this.state.username,
        email : this.state.email,
        password : this.state.password,
        rePassword : this.state.rePassword
      })
      .then( response  => {
          if(response.data.error){
            Object.values(response.data.messages).map( error => this.setState({ error : this.state.error + error[0] + "\n" }))
            this.setState({ showError : true});
             this.setState({btnDisabled : false});
          }else{
            this.setState({ showSuccess : true});            
          }
      })
    }

    RegisError = data => <SweetAlert
    show={this.state.showError}
    title="There are some errors"
    type="error"
    text={data}
    onConfirm={() => this.setState({ showError: false })}
  />

  RegisSuccess = () => <SweetAlert
  show={this.state.showSuccess}
  title="Başarılı"
  type="success"
  text="Giriş sayfasına yönlendiriliyorsunuz."
  onConfirm={() => this.setState({ showSuccess: false })}
/>


  RegisLoading = () => <Loader/>

  Form = () => { return (
    <div className="container" style={{ marginTop : '170px' }}>

    { this.RegisError(this.state.error) }
        { this.RegisSuccess() }
          <Row className="justify-content-md-center p-4 text-center">
          <Col md={5} className="p-5 shadow-lg">
          <h2 className="text-muted mb-4">Kayıt Ol</h2>
          <Form>

          <Form.Group className="shadow-sm">
        <Form.Control type="text" placeholder="Enter username" onChange={this.usernameChange} />
        
      </Form.Group>

      <Form.Group className="shadow-sm">
        <Form.Control type="email" placeholder="Enter email" onChange={this.emailChange} />
      </Form.Group>

      <Form.Group className="shadow-sm">
        <Form.Control type="password" placeholder="Password" onChange={this.passwordChange} />
      </Form.Group>
 
      <Form.Group className="shadow-sm">
        <Form.Control type="password" placeholder="Retype Password" onChange={this.rePasswordChange} />
      </Form.Group>

    <Button className="shadow visteria border-0" onClick={this.doRegister} >
          { (this.state.btnDisabled ? this.RegisLoading() : " " )  } Register
        </Button>
     
      
    </Form>
      </Col>
      </Row>
      </div>

  )}

 
    render() {
      return (
        <div>
          {
            this.state.showSuccess ? <Redirect to="login" /> : this.Form()
          }
        </div>

        )
    }
  }

export default Register;