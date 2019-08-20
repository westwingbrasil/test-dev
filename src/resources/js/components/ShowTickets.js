import axios from 'axios'
import React, { Component } from 'react'
import { Link } from 'react-router-dom'
import FilterTickets from './FilterTickets'

class ShowTickets extends Component {
    constructor (props) {
        super(props)

        this.state = {
            tickets: [],
            currentPage: 1,
            prevPageUrl: null,
            nextPageUrl: null
        }

        this.handleFilter = this.handleFilter.bind(this)
        this.fetchData = this.fetchData.bind(this)
        this.handleNextClick = this.handleNextClick.bind(this)
        this.handlePrevClick = this.handlePrevClick.bind(this)
    }

    handleNextClick (event) {
        event.preventDefault()

        if (this.state.nextPageUrl === null) return

        this.fetchData(this.state.currentPage + 1)
    };

    handlePrevClick (event) {
        event.preventDefault()

        if (this.state.prevPageUrl === null) return

        this.fetchData(this.state.currentPage - 1)
    }

    fetchData (page) {
        axios.get('/api/ticket', {
            params: {
                page: page,
                ...this.state.filters,
            }
        }).then(response => {
            this.setState({
                tickets: response.data.data,
                currentPage: response.data.current_page,
                prevPageUrl : response.data.prev_page_url,
                nextPageUrl : response.data.next_page_url
            })
        })
    }

    componentDidMount () {
        this.fetchData(1)
    }

    async handleFilter(userEmail, orderId) {

        console.log(orderId)

        await this.setState({
            filters: {
                userEmail: userEmail,
                orderId: orderId,
            }
        })

        this.fetchData(1)
    }

    render () {
        const { tickets } = this.state
        return (
            <div className='container py-4'>
                <div className='row justify-content-center'>
                    <div className='col-md-12'>
                        <div className='card'>
                            <div className='card-header'>Todos Tickets</div>
                            <div className='card-body'>
                                <div className="form-inline">
                                    <div className="form-group mb-2 ml-2">
                                        <Link className='btn btn btn-primary' to='/create'>
                                            Criar novo Ticket
                                        </Link>
                                    </div>
                                    <FilterTickets
                                        onSubmit={this.handleFilter}
                                    >
                                    </FilterTickets>
                                </div>
                                <table className="table">
                                    <thead>
                                        <tr>
                                           <th scope="col">ID</th>
                                           <th scope="col">Nº Pedido</th>
                                           <th scope="col">Título</th>
                                           <th scope="col">Email</th>
                                           <th scope="col">Criado Em</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {tickets.map(ticket => (
                                            <tr key={ticket.id}>
                                                <td>{ticket.id}</td>
                                                <td>{ticket.order_id}</td>
                                                <td>
                                                    <Link
                                                        to={`/${ticket.id}`}
                                                        key={ticket.id}
                                                    >
                                                        {ticket.title}
                                                    </Link>
                                                </td>
                                                <td>{ticket.email}</td>
                                                <td>{ticket.created_at}</td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button className={'btn btn-primary btn-sm mt-3 ' + (this.state.prevPageUrl ? '' : 'disabled')} onClick={this.handlePrevClick}>
                            Anterior
                        </button>
                        <button className={'btn btn-primary btn-sm mt-3 ml-1 ' + (this.state.nextPageUrl ? '' : 'disabled')} onClick={this.handleNextClick}>
                            Próximo
                        </button>
                    </div>
                </div>
            </div>
        )
    }
}

export default ShowTickets
