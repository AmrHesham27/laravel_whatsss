import React from "react";
import { Cart, Info, Menu, Categories as CategoriesList } from "./index";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faListSquares, faInfoCircle } from "@fortawesome/free-solid-svg-icons";
import Tab from "react-bootstrap/Tab";
import Tabs from "react-bootstrap/Tabs";

function PageBody({ store }) {
    const color_1 = localStorage.getItem("color_1");

    return (
        <div>
            <Tabs
                defaultActiveKey="menu"
                id="uncontrolled-tab-example"
                className="my-nav d-flex justify-content-end"
            >
                <Tab
                    eventKey="info"
                    title={
                        <>
                            معلومات
                            <FontAwesomeIcon
                                icon={faInfoCircle}
                                size={"1x"}
                                style={{
                                    color: color_1,
                                    marginLeft: "5px",
                                }}
                                className="menu-icon"
                            />
                        </>
                    }
                    className="nav-tabs"
                >
                    <div className="d-flex">
                        <Cart />
                        <Info store={store} />
                    </div>
                </Tab>
                <Tab
                    eventKey="menu"
                    title={
                        <>
                            القائمة
                            <FontAwesomeIcon
                                icon={faListSquares}
                                size={"1x"}
                                style={{
                                    color: color_1,
                                    marginLeft: "5px",
                                }}
                                className="menu-icon"
                            />
                        </>
                    }
                    className="nav-tabs"
                >
                    <div className="d-flex">
                        <Cart />
                        <div className="d-flex main-body">
                            <Menu
                                products={store["products"]}
                                categories={store["categories"]}
                            />
                            <CategoriesList categories={store["categories"]} />
                        </div>
                    </div>
                </Tab>
            </Tabs>
        </div>
    );
}

export default PageBody;
