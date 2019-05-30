import React from 'react';
import { Card, Button, ButtonToolbar , Form , Modal , Col ,Container ,  Row  } from 'react-bootstrap';
import { Link , Redirect } from "react-router-dom";
import {connect} from "react-redux";
import { getProjects , changeAddProjectModal ,addProject } from "../actions/project-action";
import {checkTokenIsValid} from "../actions/users-action";

class Home extends React.Component {
   
    state = {
      url: "",
      redirect: false
    };

    componentWillMount() {
        this.props.checkTokenIsValid().then( () => {
            if(this.props.userReducer.login === false){
                this.setState({ redirect : true});
            }else{
                this.props.getProjects();
            }
        })
    }

componentDidMount(){




}
  

    handleAdd = ()=> {
     this.props.addProject(this.state.url);
    }



    addProject = () => {

        return(
        <Modal show={this.props.projectReducer.addProjectModal} onHide={this.handleClose} centered>
      <Modal.Header>
        <Modal.Title>Add Project</Modal.Title>
      </Modal.Header>

      <Modal.Body>
        

      <Form>


  <Form.Group as={Row} controlId="formPlaintextPassword">
    <Form.Label column sm="2">
      Website 
    </Form.Label>
    <Col sm="10">
      <Form.Control type="text" placeholder="Your website address..." onChange={ (e) => this.setState({ url :  e.target.value})} />
    </Col>
  </Form.Group>
</Form>


      </Modal.Body>

      <Modal.Footer>
          <Button onClick={ () => this.props.changeAddProjectModal(false)} variant="secondary">Cancel</Button>
          <Button variant="primary" onClick={ this.handleAdd } className="visteria border-0">Add</Button>
      </Modal.Footer>
    </Modal>

      )
    };

render() {
    if(this.state.redirect === true){
        return <Redirect to="/login" />
    }else{
        return (

            <div>

                { this.addProject() }
                <Container style={{ marginTop : '150px' , paddingBottom : '40px'}}>
                    <Row>
                        <ButtonToolbar style={{ marginBottom: '50px', width: '100%', marginRight: '20px' }} className="justify-content-center">
                            <Button variant="primary" onClick={ () => this.props.changeAddProjectModal(true) } className="mr-2 visteria border-0" >Add Project</Button>
                            <Link style={{ color: "white"}}  to="/logout"> <Button variant="secondary" style={{ background : "#2c3e50"}}>Logout</Button></Link>
                        </ButtonToolbar>

                    </Row>
                    <Row className="justify-content-center text-center">

                        {
                            Object.values(this.props.projectReducer.projects).map( (data) => <Col sm={3} key={data.id}  className="mt-4 mr-3 ml-3 shadow-sm">
                                <Card.Body><Link to={`/project/${data.url}`}>{data.url}</Link>
                                </Card.Body>
                            </Col> )
                        }


                    </Row>
                </Container>
            </div>
        )
    }

    }
  }

const mapStateToProps = (state) => {
  return state
};

const mapDispatchToProps = {
    getProjects , addProject , changeAddProjectModal , checkTokenIsValid
}

export default connect(mapStateToProps,mapDispatchToProps)(Home);
