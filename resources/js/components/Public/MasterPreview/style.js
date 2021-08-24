import { makeStyles } from '@material-ui/core/styles';

const priviewMaster = makeStyles({
    root: {
        display: 'flex',
        width: '100%',
        alignItems: 'center',
        justifyContent: 'space-between'
    },
    ava: {
      width: '100px',
      height: '100px'
    },
    name: {
        margin: '10px 0 10px 0'
    },
    info: {
        width: '100%',
        'display': 'flex',
        'flex-direction': 'column',
        marginLeft: '40px'
    },
    spec: {
        margin: '10px 0 10px 0'
    },
    btns: {
        display: 'flex',
        flexDirection: 'column'
    }
  });

export default priviewMaster;