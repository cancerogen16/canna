import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import { Button, ButtonGroup } from '@material-ui/core';
import { store } from './store';
import About  from './pages/about/about'
import Profile from './pages/profile/profile'
import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link,
  } from 'react-router-dom';




function App() {
    return <>
     <Provider store={store}>
        <Router>
        <ButtonGroup color="primary" aria-label="outlined primary button group">
            <Button>
                <Link to="/">Главная</Link>
            </Button>
            <Button><Link to="/about">About</Link></Button>
            <Button><Link to="/profile">Profile</Link></Button>
        </ButtonGroup>
                
                
                
            <Switch>
               
                <Route path="/about">
                    <About />
                </Route>
                <Route path="/profile">
                    <Profile />
                </Route>
                <Route path="/">
                    <h1>Главная</h1>
                </Route>
            </Switch>
        </Router>
    </Provider>
    </>;
}

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
