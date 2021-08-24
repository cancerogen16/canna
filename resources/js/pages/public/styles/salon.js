import { makeStyles } from '@material-ui/core/styles';

const styleSalon = makeStyles({
    
    item: {   
        width: '100%',
        margin: '15px 0'
    },
    list: {
        padding: '0',
        display: 'flex',
        listStyle: 'none',
        justifyContent: 'space-between',
        flexWrap: 'wrap'
    },
    listItem: {
        margin: '5px 0'
    },
    modal: {
        width: '540px',
        minWidth: '300px'
    },
    active: {
        background: '#3f51b5',
        color: 'white',
        cursor: 'pointer'
        
    }
});

export default styleSalon;