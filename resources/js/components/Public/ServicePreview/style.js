import { makeStyles } from '@material-ui/core/styles';

const priviewService = makeStyles({
    root: {
        display: 'flex',
        'justify-content': 'space-between',
        'align-items': 'center',
        width: '100%'
    },
    ava: {
      width: '100px',
      height: '100px'
    },
    name: {
        margin: '10px 0 10px 0'
    },
    desc: {
        'display': 'flex',
        'flex-direction': 'column',
        width: '45%',
        padding: '0 10px',
        boxSizing: 'border-box'
    },
    info: {
        width: '25%',
        padding: '0 10px'
    },
    spec: {
        margin: '10px 0 10px 0'
    },
    btns: {
        display: 'flex',
        flexDirection: 'column'
    }
  });

export default priviewService;