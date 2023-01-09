import React from "react";

function info({ store }) {    
    return (
        <div className="info col">
            <div className="info-header">{ store['name'] }</div>
            <div className="info-item row">
                <div className="col">
                    { store['end_time'] } - { store['start_time'] } 
                </div>
                <div className="col">ساعات العمل</div>
            </div>
        </div>
    );
}

export default info;
