import React from "react";
import { useSelector } from "react-redux";

function pageHeader({image}) {

    const cart = useSelector(state => state)
    return (
        <div className="my-header">
            <div>
                <img
                    src={`/stores_logos/${image}`}
                    alt="store logo"
                    onClick={() => console.log(cart)}
                />
            </div>
        </div>
    );
}

export default pageHeader;
