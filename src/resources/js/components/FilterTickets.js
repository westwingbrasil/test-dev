import React, { Component } from 'react'

class FilterTickets extends Component {
    constructor (props) {
        super(props)
        this.state = {
            email: '',
            orderId: ''
        }
        this.handleFieldChange = this.handleFieldChange.bind(this)
        this.filterTickets = this.filterTickets.bind(this)
    }

    handleFieldChange (event) {
        this.setState({
            [event.target.name]: event.target.value
        })
    }

    filterTickets (event) {
        event.preventDefault()

        const { email, orderId } = this.state
        const { onSubmit } = this.props

        onSubmit(email, orderId)
    }

    render () {
        return (
            <form className='form-inline' onSubmit={this.filterTickets}>
                <div className="form-group mb-2 ml-4">
                    <label htmlFor='description'>E-mail do Cliente</label>
                    <input
                        id='email'
                        name='email'
                        className='form-control ml-2'
                        type='text'
                        value={this.state.email}
                        onChange={this.handleFieldChange}
                    />
                </div>
                <div className="form-group mb-2 ml-2">
                    <label htmlFor='description'>Número do Pedido</label>
                    <input
                        id='orderId'
                        name='orderId'
                        className='form-control ml-2'
                        type='text'
                        value={this.state.orderId}
                        onChange={this.handleFieldChange}
                    />
                </div>
                <div className="form-group mb-2 ml-2">
                    <button className='btn btn-primary'>Filtrar</button>
                </div>
            </form>

        )
    }
}

export default FilterTickets
