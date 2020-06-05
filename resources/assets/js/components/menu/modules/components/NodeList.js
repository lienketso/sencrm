import React, {Component} from 'react';
import Aux from 'react-aux';
import {connect} from 'react-redux';
import * as actions from '../actions/Index';
import { map as _map } from 'lodash';

class NodeList extends Component
{
    constructor(props) {
        super(props);
    }

    componentWillMount() {
        this.props.getPost();
    }

    render() {
        const { PageReducer = {} } = this.props;
        return(
            <Aux>
                <div className="col-sm-4">
                    <div className="card">
                        <div className="card-header">
                            <h5 className="card-title">Page</h5>
                        </div>
                        <div className="card-body">
                            <div className="form-group">
                                <div className="menu-node-list">
                                    {
                                        PageReducer.pages && _map(PageReducer.pages, ({ id, name, slug }) => (
                                            <div className="form-group" key={id}>
                                                <label>
                                                    {name}
                                                    <Checkbox name={name} checked={this.state.checkedItems.get(name)} onChange={this.handleChange} />
                                                </label>
                                            </div>
                                        ))
                                    }
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </Aux>
        )
    }
}

const mapStateToProps = (state) => {
    return state;
}

const mapDispatchToProps = (dispatch, props) => {
    return {
        getPost: () => {
            dispatch(actions.getPost())
        }
    }
}


export default connect(mapStateToProps, mapDispatchToProps) (NodeList);