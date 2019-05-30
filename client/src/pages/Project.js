import React from 'react';
import {  Table , Button, ButtonToolbar , Form , Modal , Col ,Container ,  Row  } from 'react-bootstrap';
import {Link, Redirect} from "react-router-dom";
import {
    getProject,
    addKeyword,
    changeAddKeywordModal,
    doUpdateKeyword
} from "../actions/project-action";
import {connect} from "react-redux";
import {checkTokenIsValid} from "../actions/users-action";


  class Project extends React.Component {

    state= {
        keyword : "",
        country : "com",
        loading: { },
        redirect : false
     }

   componentDidMount(){
    this.props.checkTokenIsValid().then( () => {
            if(this.props.userReducer.login === false){
                this.setState({ redirect : true});
            }else{
                this.props.getProject(this.props.match.params.website);
            }
        })


   }


    handleAdd = () => this.props.addKeyword(this.state.keyword,this.state.country,this.props.match.params.website);

    updateKeywords = () => Object.keys(this.props.projectReducer.project).map( id => this.updateKeyword(id));

    updateKeyword = (id) => this.props.doUpdateKeyword(id);

    addKeyword = () => {
        return(
          <Modal show={this.props.projectReducer.addKeywordModal} onHide={this.handleClose} centered>
        <Modal.Header>
          <Modal.Title>Add Keyword</Modal.Title>
        </Modal.Header>
  
        <Modal.Body>
          
  
        <Form>
  
  
    <Form.Group as={Row} controlId="formPlaintextPassword">
      <Form.Label column sm="2">
        Keyword 
      </Form.Label>
      <Col sm="10">
        <Form.Control type="text" placeholder="Your keyword" onChange={ (e) => this.setState({ keyword :  e.target.value})} />
      </Col>
    </Form.Group>

    <Form.Group as={Row} controlId="formGridState">
      <Form.Label  column sm="2">Country</Form.Label>
      <Col sm="10">
      <Form.Control  onChange={ (e) => this.setState( {country : e.target.value})} as="select">
        <option value=".com">com</option>
        <option value=".com.tr">com.tr</option>
      </Form.Control>
      </Col>
    </Form.Group>

   


  </Form>
  
  
        </Modal.Body>
  
        <Modal.Footer>
          <Button onClick={ () => this.props.changeAddKeywordModal(false)} variant="secondary">Cancel</Button>
          <Button variant="primary" onClick={ this.handleAdd } className="visteria border-0">Add</Button>
        </Modal.Footer>
      </Modal>
  
        )
      }
      

    render(){

        if(this.state.redirect === true){
            return <Redirect to="/login" />
        }
        return(
            <div>
                { this.addKeyword() }
                <Container style={{ marginTop: "150px"}}>
                
                <Row>
            <ButtonToolbar style={{ marginBottom: '50px', width: '100%', marginRight: '20px' }} className="justify-content-center">
            <Button variant="success" onClick={ () => this.updateKeywords() } className="mr-2 border-0" >Update Keywords</Button>

              <Button variant="primary" onClick={ () => this.props.changeAddKeywordModal(true) } className="mr-2 visteria border-0" >Add Keyword</Button>
              <Link style={{ color: "white"}} to={`/`} ><Button variant="secondary" style={{ background : "#2c3e50"}}>Back to Projects</Button></Link>
            </ButtonToolbar>
           
          </Row>
                <Row>
                <Table responsive>
  <thead>
    <tr>
      <th>Keyword</th>
      <th>Best</th>
      <th>Position</th>
      <th>Last Check Date</th>
      <th></th>
    </tr>
  </thead>
  <tbody>

  { Object.values(this.props.projectReducer.project).map( (info) =>  <tr key={info.id}>
      <td>{ info.keyword } </td>
      <td>{ info.bestPosition }</td>
      <td>{ info.lastPosition.position } </td>
      <td>{ info.lastPosition.date } </td>
      <td>  <Button onClick={() => this.updateKeyword(info.id)} className="btn border-0">Update</Button>   </td>
      
    </tr>
    ) }
   
  </tbody>
</Table>
                </Row>

                </Container>
            </div>
        )
    }
  }
const mapStateToProps = (state) => {
    return state
};

const mapDispatchToProps = {
    getProject ,addKeyword, changeAddKeywordModal , doUpdateKeyword , checkTokenIsValid
};

export default connect(mapStateToProps,mapDispatchToProps)(Project);
