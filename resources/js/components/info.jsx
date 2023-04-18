import React from "react";

function Info({ store }) {
    const store_name = localStorage.getItem('name');
    const store_start_time = localStorage.getItem('start_time');
    const store_end_time = localStorage.getItem('end_time');

    let startTime = new Date('2022-01-01T' + store_start_time);
    let endTime = new Date('2022-01-01T' + store_end_time);

    let startHours = startTime.getHours() > 12 ? (startTime.getHours() - 12) : startTime.getHours();
    let endHours = endTime.getHours() > 12 ? (endTime.getHours() - 12) : endTime.getHours();

    console.log(endHours, endTime.getHours(), typeof(endTime.getHours()))

    const getTimePeriod = (hours) => {
        if (hours >= 12) {
            hours -= 12;
            return 'مساءا';
        } 
        return 'صباحا'; 
    }

    const startTimePeriod = getTimePeriod(startTime.getHours())
    const endTimePeriod = getTimePeriod(endTime.getHours())
    
    return (
        <div className="info col">
            <div className="info-header px-3">{store_name}</div>
            
            <div className="info-item row">
                <div className="col" style={{textAlign: 'inherit'}}>
                    {store['description']}
                </div>
                <div className="col">الوصف</div>
            </div>

            <div className="info-item row">
                <div className="col d-flex">
                    <div style={{marginRight: '10px'}}>
                        <span style={{ float: 'right', marginLeft: '5px' }}>{endHours}</span> {endTimePeriod}
                    </div>
                    <div>الي</div>
                    <div style={{marginLeft: '10px'}}>
                        <span style={{ float: 'right', marginLeft: '5px' }}>{startHours}</span> {startTimePeriod}
                    </div>
                </div>
                <div className="col">ساعات العمل</div>
            </div>


            <div style={{ maxWidt: '100vw', marginTop: '50px' }}>
                {
                    store['google_maps'] ? <iframe
                        src={store['google_maps']}
                        style={{ border: 0, width: '100%' }} allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe> : undefined
                }
            </div>
        </div>
    );
}

export default Info;
