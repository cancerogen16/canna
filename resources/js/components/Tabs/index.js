import React from 'react';
import PropTypes from 'prop-types';
import {makeStyles} from '@material-ui/core/styles';
import AppBar from '@material-ui/core/AppBar';
import Tabs from '@material-ui/core/Tabs';
import Tab from '@material-ui/core/Tab';

export function TabPanel(props) {
    const {children, value, index, ...other} = props;

    return (
        <div
            role="tabpanel"
            hidden={value !== index}
            id={`simple-tabpanel-${index}`}
            aria-labelledby={`simple-tab-${index}`}
            {...other}
        >
            {value === index && (
                <div>
                    {children}
                </div>
            )}
        </div>
    );
}

TabPanel.propTypes = {
    children: PropTypes.node,
    index: PropTypes.any.isRequired,
    value: PropTypes.any.isRequired,
};

function a11yProps(index) {
    return {
        id: `simple-tab-${index}`,
        'aria-controls': `simple-tabpanel-${index}`,
    };
}

const useStyles = makeStyles((theme) => ({
    root: {
        flexGrow: 1,
        backgroundColor: theme.palette.background.paper,
    },
}));

export function SimpleTabs(props) {
    const classes = useStyles();
    //const [value, setValue] = React.useState(0);

    return (
        <div className={classes.root}>
            <AppBar position="static">
                <Tabs value={props.value} onChange={props.handleChange} aria-label="simple tabs example">
                    {/* <Tab label="Item One" {...a11yProps(0)} />
          <Tab label="Item Two" {...a11yProps(1)} />
          <Tab label="Item Three" {...a11yProps(2)} /> */}
                    {props.tabs.map(item => {
                        return <Tab key={item.index} label={item.label} {...a11yProps(item.index)} />
                    })}
                </Tabs>
            </AppBar>
            {props.children.map(item => {
                //item.props.value = value;
                return item;
            })}
            {/* {console.log(props.children)}
      {props.children} */}
        </div>
    );
}
