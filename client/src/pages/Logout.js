import React from 'react';
import { Container, Button } from 'react-bootstrap';
import { Link } from "react-router-dom";
import { changeLoginStatus } from "../actions/users-action";
import {connect} from "react-redux";


class Logout extends React.Component {
  
    componentDidMount(){
        localStorage.removeItem('token');
        this.props.changeLoginStatus(false);
    }

    render(){
        return(
            <Container className="text-center mt-5 pt-5">
                <Link style={{ color: "white"}} to={`/login`}><Button>Login</Button></Link>
            </Container>
        )
    }

}

const mapStateToProps = (state) => {
    return state
};

const mapDispatchToProps = {
   changeLoginStatus
};

export default connect(mapStateToProps,mapDispatchToProps)(Logout);
