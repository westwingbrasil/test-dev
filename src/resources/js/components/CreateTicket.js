import axios from 'axios'
import React, { Component } from 'react'

class CreateTicket extends Component {
    constructor (props) {
        super(props)
        this.state = {
            title: '',
            content: '',
            orderId: '',
            name: '',
            email: '',
            errors: []
        }
        this.handleFieldChange = this.handleFieldChange.bind(this)
        this.handleCreateNewTicket = this.handleCreateNewTicket.bind(this)
        this.hasErrorFor = this.hasErrorFor.bind(this)
        this.renderErrorFor = this.renderErrorFor.bind(this)
    }

    handleFieldChange (event) {
        this.setState({
            [event.target.name]: event.target.value
        })
    }

    handleCreateNewTicket (event) {
        event.preventDefault()

        const { history } = this.props

        const ticket = {
            title: this.state.title,
            content: this.state.content,
            orderId: this.state.orderId,
            name: this.state.name,
            email: this.state.email
        }

        axios.post('/api/ticket', ticket)
            .then(response => {
                // redirect to the homepage
                history.push('/')
            })
            .catch(error => {
                this.setState({
                    errors: error.response.data.errors
                })
            })
    }

    hasErrorFor (field) {
        return !!this.state.errors[field]
    }

    renderErrorFor (field) {
        if (this.hasErrorFor(field)) {
            return (
                <span className='invalid-feedback'>
              <strong>{this.state.errors[field][0]}</strong>
            </span>
            )
        }
    }

    render () {
        return (
            <div className='container py-4'>
                <div className='row justify-content-center'>
                    <div className='col-md-12'>
                        <div className='card'>
                            <div className='card-header'>Criar novo ticket</div>
                            <div className='card-body'>
                                <form onSubmit={this.handleCreateNewTicket}>
                                    <div className='form-group'>
                                        <label htmlFor='description'>Nome do Cliente</label>
                                        <input
                                            id='name'
                                            className={`form-control ${this.hasErrorFor('name') ? 'is-invalid' : ''}`}
                                            name='name'
                                            type='text'
                                            value={this.state.name}
                                            onChange={this.handleFieldChange}
                                        />
                                        {this.renderErrorFor('name')}
                                    </div>
                                    <div className='form-group'>
                                        <label htmlFor='description'>Email do Cliente</label>
                                        <input
                                            id='email'
                                            className={`form-control ${this.hasErrorFor('email') ? 'is-invalid' : ''}`}
                                            name='email'
                                            type='text'
                                            value={this.state.email}
                                            onChange={this.handleFieldChange}
                                        />
                                        {this.renderErrorFor('email')}
                                    </div>
                                    <div className='form-group'>
                                        <label htmlFor='description'>Número do Pedido</label>
                                        <input
                                            id='orderId'
                                            className={`form-control ${this.hasErrorFor('orderId') ? 'is-invalid' : ''}`}
                                            name='orderId'
                                            type='text'
                                            value={this.state.orderId}
                                            onChange={this.handleFieldChange}
                                        />
                                        {this.renderErrorFor('orderId')}
                                    </div>

                                    <div className='form-group'>
                                        <label htmlFor='name'>Título</label>
                                        <input
                                            id='title'
                                            type='text'
                                            className={`form-control ${this.hasErrorFor('title') ? 'is-invalid' : ''}`}
                                            name='title'
                                            value={this.state.title}
                                            onChange={this.handleFieldChange}
                                        />
                                        {this.renderErrorFor('title')}
                                    </div>
                                    <div className='form-group'>
                                        <label htmlFor='description'>Conteúdo</label>
                                        <textarea
                                            id='content'
                                            className={`form-control ${this.hasErrorFor('content') ? 'is-invalid' : ''}`}
                                            name='content'
                                            rows='10'
                                            value={this.state.content}
                                            onChange={this.handleFieldChange}
                                        />
                                        {this.renderErrorFor('content')}
                                    </div>

                                    <button className='btn btn-primary'>Criar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default CreateTicket
