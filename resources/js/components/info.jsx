import React from "react";

function Info() {    
    const store_name = localStorage.getItem('name');
    const store_start_time = localStorage.getItem('start_time');
    const store_end_time = localStorage.getItem('end_time');

    return (
        <div className="info col">
            <div className="info-header px-3">{store_name}</div>
            <div className="info-item row">
                <div className="col">
                    {store_end_time} - {store_start_time} 
                </div>
                <div className="col">ساعات العمل</div>
            </div>
        </div>
    );
}

export default Info;
