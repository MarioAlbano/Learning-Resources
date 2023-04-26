import { BrowserRouter, Routes, Route } from "react-router-dom";
import Home from "./pages/Home";
import More from "./pages/More";
import Contact from "./pages/Contact";
import Header from "./components/Header";
import Error from "./components/Error";

function RoutesApp() {
  return (
    <>
      <Header />
      <BrowserRouter>
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/sobre" element={<More />} />
          <Route path="/contato" element={<Contact />} />
          <Route path="*" element={<Error />} />
        </Routes>
      </BrowserRouter>
    </>
  );
}
export default RoutesApp;
