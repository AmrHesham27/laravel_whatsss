import React from "react";
import { Cart, Info, Menu, Categories as CategoriesList } from "./index";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faUtensils, faInfoCircle } from "@fortawesome/free-solid-svg-icons";
import Tab from "react-bootstrap/Tab";
import Tabs from "react-bootstrap/Tabs";

function PageBody({ store }) {
    const color_1 = localStorage.getItem("color_1");

    return (
        <div>
            {/* <div className="d-flex flex-column mb-5">
                <nav className="navbar my-nav d-flex justify-content-end">
                    <div className="nav nav-tabs" id="nav-tab" role="tablist">
                        <a
                            className="nav-item nav-link active"
                            id="nav-home-tab"
                            data-toggle="tab"
                            href="#nav-home"
                            role="tab"
                            aria-controls="nav-home"
                            aria-selected="true"
                        >
                            قائمة الطعام
                            <FontAwesomeIcon
                                icon={faUtensils}
                                size={"1x"}
                                style={{
                                    color: color_1,
                                    marginLeft: "5px",
                                }}
                                className="menu-icon"
                            />
                        </a>

                        <a
                            className="nav-item nav-link f-18"
                            id="nav-profile-tab"
                            data-toggle="tab"
                            href="#nav-profile"
                            role="tab"
                            aria-controls="nav-profile"
                            aria-selected="false"
                        >
                            معلومات المطعم
                            <FontAwesomeIcon
                                icon={faInfoCircle}
                                size={"1x"}
                                style={{
                                    color: color_1,
                                    marginLeft: "5px",
                                }}
                                className="menu-icon"
                            />
                        </a>
                    </div>
                </nav>

                <div className="d-flex">
                    <Cart />
                    <div className="tab-content" id="nav-tabContent">
                        <div
                            className="tab-pane fade"
                            id="nav-profile"
                            role="tabpanel"
                            aria-labelledby="nav-profile-tab"
                        >
                            <div className="body-container">
                                <Info />
                            </div>
                        </div>
                        <div
                            className="tab-pane fade show active"
                            id="nav-home"
                            role="tabpanel"
                            aria-labelledby="nav-home-tab"
                        >
                            <div className="body-container">
                                <Menu
                                    products={store["products"]}
                                    categories={store["categories"]}
                                />
                                <CategoriesList
                                    categories={store["categories"]}
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div> */}
            <Tabs
                defaultActiveKey="menu"
                id="uncontrolled-tab-example"
                className="my-nav d-flex justify-content-end"
            >
                <Tab
                    eventKey="info"
                    title={
                        <>
                            معلومات المطعم
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
                        <Info />
                    </div>
                </Tab>
                <Tab
                    eventKey="menu"
                    title={
                        <>
                            قائمة الطعام
                            <FontAwesomeIcon
                                icon={faUtensils}
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
                        <div className="d-flex">
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
