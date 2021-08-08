import { makeStyles } from '@material-ui/core/styles';

const priviewService = makeStyles({
    root: {
        display: 'flex',
        'justify-content': 'space-between',
        'align-items': 'center'
    },
    ava: {
      width: '100px',
      height: '100px'
    },
    name: {
        margin: '10px 0 10px 0'
    },
    info: {
        display: 'flex',
        maxWidth: '785px',
        flexDirection: 'column',
        margin: '0 40px'
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