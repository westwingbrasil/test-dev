import axios from 'axios'
import React, { Component } from 'react'

class ShowTicket extends Component {
    constructor (props) {
        super(props)
        this.state = {
            ticket: {}
        }
    }

    componentDidMount () {
        const ticketId = this.props.match.params.id

        axios.get(`/api/ticket/${ticketId}`).then(response => {
            this.setState({
                ticket: response.data
            })
        })
    }

    render () {
        const ticket = this.state.ticket

        return (
            <div className='container py-4'>
                <div className='row justify-content-center'>
                    <div className='col-md-12'>
                        <div className='card'>
                            <div className='card-header'>{ticket.id} - {ticket.title}</div>
                            <div className='card-body'>
                                <div className="form-group">
                                    <span>Nome do Cliente: </span>
                                    <b>{ticket.name}</b>
                                </div>
                                <div className="form-group">
                                    <span>Email do Cliente: </span>
                                    <b>{ticket.email}</b>
                                </div>
                                <div className="form-group">
                                    <div className="form-group">
                                        <span>Número do Pedido: </span>
                                        <b>{ticket.order_id}</b>
                                    </div>
                                </div>
                                <div className="form-group">
                                    <span>Conteúdo: </span>
                                    <b>{ticket.content}</b>
                                </div>
                                <div className="form-group">
                                    <span>Criado em: </span>
                                    <b>{ticket.created_at}</b>
                                </div>
                                <div className="form-group">
                                    <span>Atualizado em: </span>
                                    <b>{ticket.updated_at}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default ShowTicket
