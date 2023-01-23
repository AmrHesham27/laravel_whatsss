import React from "react";

function PageHeader({image}) {

    return (
        <div className="my-header">
            <div>
                <img
                    src={`/images/${image}`}
                    alt="store logo"
                />
            </div>
        </div>
    );
}

export default PageHeader;
