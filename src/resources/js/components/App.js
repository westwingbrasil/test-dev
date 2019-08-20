import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import Header from './Header'
import ShowTicket from './ShowTicket'
import ShowTickets from './ShowTickets'
import CreateTicket from './CreateTicket'

class App extends Component {
    render () {
        return (
            <BrowserRouter>
                <div>
                    <Header />
                    <Switch>
                        <Route exact path='/' component={ShowTickets} />
                        <Route path='/create' component={CreateTicket} />
                        <Route path='/:id' component={ShowTicket} />
                    </Switch>
                </div>
            </BrowserRouter>
        )
    }
}

ReactDOM.render(<App />, document.getElementById('app'))