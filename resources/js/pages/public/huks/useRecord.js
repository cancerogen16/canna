import { useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import { fetchTimesMaster } from "../../../store/times/thunks";


export default function useRecord() {
    const dispatch = useDispatch();
    const [open, setOpen] = useState(false);
    const times = useSelector(state => state.times);
    const [cretendials, setCretendials] = useState({
        master_id: '',
        service_id: '',
        date: ''
    })

    const handleClose = () => {
        setOpen(false);
    };

    const handleRecord = (e, master_id, service_id) => {
        setOpen(!open);
        if (master_id) {
            dispatch(fetchTimesMaster(master_id));
        }
        
        setCretendials({...cretendials, master_id, service_id })
        e.stopPropagation();
      }

      const handleEditRecordForm = (e) => {
        console.log(e.target.name);
        switch(e.target.name){
            case 'master':
                setCretendials({...cretendials, master_id: e.target.value})
                dispatch(fetchTimesMaster(e.target.value))
                break;
            case 'service':
                setCretendials({...cretendials, service_id: e.target.value})
                break;
            case 'date':
                setCretendials({...cretendials, date: e.target.value})
                dispatch(fetchTimesMaster(cretendials.master_id, e.target.value ))
                break;
        }
    }

    return {
        open,
        cretendials,
        times,
        handleClose,
        handleRecord,
        handleEditRecordForm,
    }
}