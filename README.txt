QUY TRÌNH SỬ DỤNG
_____________________________________________________________________________________________________________
Mới vào sẽ hiển thị giao diện CHÀO MỪNG ĐẾN TRANG WEB.
Nhấn vào Login để đăng nhập và sử dụng dịch vụ.
Nhập tài khoản và password. (admin-admin cho quyền giám đốc)
----------------------------------
1. Đăng nhập bằng quyền giám đốc
Giao diện đầu tiên sẽ hiển thị danh sách nhân viên của công ty.
Chọn mục "Quản lý tài khoản" để hiển thị danh sách tài khoản trong công ty
Chọn mục "Quản lý phòng ban" để hiển thị danh sách phòng ban trong công ty
Chọn mục "Xem ngày nghỉ" để hiển thị danh sách ngày nghỉ của trưởng phòng.

Cần Tạo phòng ban cho công ty trước khi tạo các mục còn lại.
	Vào "Quản lý phòng ban" chọn "Thêm phòng ban".
	Lưu ý: Số phòng ít nhất bằng 1.
	Bấm "Thêm mới" để thêm phòng ban. 
	Màn hình sẽ hiển thị danh sách phòng ban (chưa có trưởng phòng).
Tạo nhân viên cho công ty khi đã có phòng ban
	Vào "Xem nhân viên" chọn "Thêm nhân viên"
	Cần nhập đầy đủ thông tin của nhân viên. 
	Lưu ý:	Ngày sinh của nhân viên phải thể hiện nhân viên đã đủ 18 tuổi
		Email chính là tài khoản của nhân viên.
		Ảnh đại diện phải là file JPEG, JPG, PNG hoặc GIF và nhỏ hơn 1MB
	Bấm "Thêm mới" để thêm nhân viên. 
	Lúc này Tài khoản của nhân viên sẽ tự tạo và có username, password là email nhân viên đã nhập
Tạo trưởng phòng cho công ty
	Vào phòng ban cần tạo chọn nút "Chỉnh sửa" để chọn trưởng phòng
	Có thể thay đổi thông tin của phòng.
	Chọn trưởng phòng là nhân viên trong phòng ban. Nhấn "Cập nhật" để hoàn tất
	Màn hình sẽ hiển thị danh sách phòng ban (đã có trưởng phòng).
	Có thể thay đổi trưởng phòng bằng cách tương tự.
Thay đổi thông tin tài khoản của nhân viên
	Chọn thông tin cần thay đổi (ngoại trừ chức vụ nhân viên)
	Lưu ý:	Tài khoản cần phải khác tài khoản đã có trong data
		Mật khẩu cần nhập giống nhau ở cả 2 lần nhập
	Bấm "Cập nhật" để hoàn tất. Màn hình sẽ hiển thị danh sách tài khoản (đã chỉnh sửa)
	Có thể reset mật khẩu bằng cách bấm vào "Reset mật khẩu".
Quản lý ngày nghỉ
	Bấm vào "Xem ngày nghỉ", màn hình sẽ hiển thị danh sách yêu cầu xin nghỉ của các trưởng phòng
	Bấm vào "Xem" để xem thông tin chi tiết
	Bấm "Đồng ý" hoặc "không đồng ý"
Xem thông tin nhân viên trong phòng
	Vào quản lý phòng ban, bấm "Xem"
	Giao diện hiển thị danh sách nhân viên trong phòng
------------------------------------
2. Đăng nhập bằng quyền trưởng phòng
Nếu lần đầu đăng nhập hoặc đã được reset mật khẩu thì cần phải đổi mật khẩu mới
Lưu ý:	Mật khẩu không được để trống
	Mật khẩu cần nhập giống nhau ở cả 2 lần nhập
Giao diện đầu tiên sẽ hiển thị danh sách công việc đã giao.
Chọn mục "Thông tin cá nhân" để hiển thị thông tin của trưởng phòng.
Chọn mục "Xem ngày nghỉ" để hiển thị danh sách ngày xin nghỉ của nhân viên gửi lên phê duyệt và của mình đã gửi lên giám đốc chờ duyệt

Thêm công việc cho nhân viên
	Ở danh sách công việc, bấm vào "Thêm công việc"
	Nhập các thông tin cần thiết
	Lưu ý:	Deadline cần phải lớn hơn ngày hiện tại
	Chọn nhân viên thực hiện (chỉ chọn được nhân viên trong phòng ban mình quản lý)
	Bấm "Thêm mới" để hoàn tất, màn hình sẽ hiển thị danh sách công việc

Xem thông tin công việc
	Ở danh sách công việc, bấm vào Xem (hình kính lúp) để xem thông tin chi tiết công việc
	Nếu công việc ở trạng thái NEW, trưởng phòng có thể hủy bằng cách bấm vào "Hủy task" chuyển task về trạng thái CANCELED
	Nếu công việc ở trạng thái IN PROCESS, trưởng phòng không thể hủy task
	Nếu công việc ở trạng thái CANCELED, task đã bị hủy, nhân viên không thể thấy
	Nếu công việc ở trạng thái WAITING
	- Trưởng phòng có thể bấm "Đồng ý" để hoàn thành task, hệ thống sẽ ghi nhận ngày submit và Deadline để xem task này có bị trễ deadline hay không
	- Trưởng phòng có thể bấm "Không đồng ý" để chuyển task về trạng thái REJECTED (khi gia hạn deadline, ngày gia hạn phải sau deadline ban đầu)
	Nếu công việc ở trạng thái REJECTED, trưởng phòng chờ nhân viên submit để task quay lại trạng thái WAITING
	Nếu công việc ở trạng thái COMPLETED, task được xem đã hoàn thành. Màn hình sẽ hiển thị xem task có bị trễ deadline hay không.
Thay đổi ảnh đại diện:
	Bấm vào "Thông tin cá nhân", chọn hình cần đổi và nhấn "Thay đổi ảnh đại diện"
	Lưu ý:	Ảnh đại diện phải là file JPEG, JPG, PNG hoặc GIF và nhỏ hơn 1MB
Xin nghỉ phép:
	Bấm vào "Xin nghỉ phép", nhập thông tin và nhấn Gửi để hoàn tất
	Lưu ý: Trưởng phòng nếu đã nghỉ 20 ngày sẽ không thể xin nghỉ tiếp
		Ngày xin nghỉ phải lớn hơn ngày hiện tại
	Bấm vào "Gửi" để hoàn tất. Màn hình sẽ hiện danh sách ngày nghỉ (đã update)
	Nếu đã nghỉ hơn 1 ngày. Sẽ hiển thị Nút "Các ngày đã nghỉ"
Xem lịch sử ngày nghỉ
	Bấm vào "Các ngày đã nghỉ" để xem lịch sử ngày nghỉ
	Lưu ý: Chỉ nhân viên đã có ngày nghỉ mới có thể xem lịch sử ngày nghỉ
Xem thông tin chi tiết ngày nghỉ
	Bấm vào nút "Xem" để xem thông tin chi tiết
	Nếu là ngày nghỉ của cấp dưới sẽ hiển thị 2 nút "Đồng ý"và "Không đồng ý" để đồng ý duyệt hoặc không
Đổi mật khẩu:
	Bấm vào "Đổi mật khẩu".
	Cần nhập mật khẩu giống nhau ở cả 2 lần nhập
	Bấm "Cập nhật" để hoàn tất
---------------------------------
3. Đăng nhập bằng quyền nhân viên
Nếu lần đầu đăng nhập hoặc đã được reset mật khẩu thì cần phải đổi mật khẩu mới
Lưu ý:	Mật khẩu không được để trống
	Mật khẩu cần nhập giống nhau ở cả 2 lần nhập
Giao diện đầu tiên sẽ hiển thị danh sách công việc mới, cần start để bắt đầu làm việc.
Chọn mục "Thông tin cá nhân" để hiển thị thông tin của nhân viên.
Chọn mục "Xem ngày nghỉ" để hiển thị danh sách ngày xin nghỉ của nhân viên gửi lên phê duyệt

Xem danh sách công việc:
	Chọn mục "Công việc". Màn hình sẽ hiển thị danh sách công việc và trạng thái của công việc
	Bấm vào "Xem" để xem thông chi tiết của công việc
	Nếu công việc ở trạng thái NEW, nhân viên cần bấm Start để bắt đầu và chuyển trạng thái thành IN PROCESS
	Nếu công việc ở trạng thái IN PROCESS, nhân viên bấm Submit khi đã hoàn thành công việc, huyển trạng thái thành Waiting
	Nếu công việc ở trạng thái WAITING, nhân viên cần chờ phản hồi từ trưởng phòng
	Nếu công việc ở trạng thái REJECTED, nhân viên cần xem lý do bị từ chối, và bấm Submit khi đã hoàn thành
	Nếu công việc ở trạng thái COMPLETED, hệ thống sẽ hiển thị trạng thái hoàn thành (Đúng hạn/ Trễ hạn) của công việc
Thay đổi ảnh đại diện:
	Bấm vào "Thông tin cá nhân", chọn hình cần đổi và nhấn "Thay đổi ảnh đại diện"
	Lưu ý:	Ảnh đại diện phải là file JPEG, JPG, PNG hoặc GIF và nhỏ hơn 1MB
Đổi mật khẩu:
	Bấm vào "Đổi mật khẩu".
	Cần nhập mật khẩu giống nhau ở cả 2 lần nhập
	Bấm "Cập nhật" để hoàn tất

Xin nghỉ phép:
	Bấm vào "Xin nghỉ phép", nhập thông tin và nhấn Gửi để hoàn tất
	Lưu ý: Trưởng phòng nếu đã nghỉ 15 ngày sẽ không thể xin nghỉ tiếp
		Ngày xin nghỉ phải lớn hơn ngày hiện tại
	Bấm vào "Gửi" để hoàn tất. Màn hình sẽ hiện danh sách ngày nghỉ (đã update)
	Nếu đã nghỉ hơn 1 ngày. Sẽ hiển thị Nút "Các ngày đã nghỉ"	
Xem lịch sử ngày nghỉ
	Bấm vào "Các ngày đã nghỉ" để xem lịch sử ngày nghỉ
	Lưu ý: Chỉ nhân viên đã có ngày nghỉ mới có thể xem lịch sử ngày nghỉ

CÁC LOGIC BÊN NGOÀI
________________________________________________________________________________________________________________________________
Khi xóa nhân viên thì tài khoản, ngày nghỉ của nhân viên đó sẽ bị xóa.
Khi xóa nhân viên nếu nhân viên có công việc chưa hoàn thành thì chuyển tất cả công việc về cho trưởng phòng với trạng thái là NEW.
Khi xóa trưởng phòng sẽ xóa toàn bộ công việc mà trưởng phòng đó đang làm (nếu có) và ngày nghỉ của trưởng phòng
Chỉ xem được lịch sử ngày nghỉ khi nhân viên đã nghỉ trên 1 ngày.
Không thể điều chỉnh tài khoản Giám đốc từ trang web
Nếu xóa phòng ban, tất cả nhân viên (kể cả trưởng phòng), ngày nghỉ, công việc trong phòng ban đó sẽ bị xóa
Chỉ tạo được tài khoản khi tạo nhân viên mới
Nếu bổ nhiệm nhân viên thành trưởng phòng, công việc của nhân viên đó sẽ chuyển về trạng thái NEW
Công ty cần tạo phòng ban trước khi tạo nhân viên
Cần có nhân viên trong phòng thì trưởng phòng mới giao công việc được
Tuổi của nhân viên phải lớn hơn 18.
Số phòng của phòng ban không thể nhỏ hơn 1
Có thể xem file đính kèm khi trưởng phòng giao task
Giao Deadline phải lớn hơn hoặc bằng ngày hiện tại
Ngày gia hạn deadline phải lớn hơn deadline cũ
Ngày hoàn thành nhiệm vụ chỉ hiển thị khi nhân viên đã bấm submit công việc đó
cố tính truy cập sai bằng link sẽ hiện báo lỗi:
	chỉ trưởng phòng mới thêm được công việc
	chỉ giám đốc mới vào điều chỉnh phòng ban được


YÊU CẦU CHƯA THỰC HIỆN ĐƯỢC
__________________________________________________________________________________________________________________________________
Không xem được lịch sử công việc
Không sử dụng Docker





