import React, {Component} from 'react';
import Aux from 'react-aux';
import NodeList from "./components/NodeList";

class Main extends Component
{
    render() {
        return(
            <Aux>
                <div className="row">
                    <NodeList/>

                    <div className="col-sm-12">

                    </div>
                </div>
            </Aux>
        )
    }
}


export default Main;