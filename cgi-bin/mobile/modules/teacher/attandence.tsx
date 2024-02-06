// withHooks
import { memo } from 'react';
import { MaterialIconsTypes } from '@expo/vector-icons/build/esoftplay_icons';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibInput_rectangle2 } from 'esoftplay/cache/lib/input_rectangle2/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import esp from 'esoftplay/esp';
import moment from 'esoftplay/moment';
import useSafeState from 'esoftplay/state';
import { useEffect, useRef, useState } from 'react';
import React from 'react';
import { FlatList, Modal, Pressable, Text, TextInput, TouchableOpacity, View } from 'react-native';
import { get } from 'react-native/Libraries/TurboModule/TurboModuleRegistry';




export interface TeacherAttendenceArgs {

}
export interface TeacherAttendenceProps {


}





function m(props: TeacherAttendenceProps): any {
  const [popupVisible, setPopupVisible] = useState(false);
  const [ijinVisible, setIjinVisible] = useState(false)
  let [studentId, setstudentId] = useSafeState(0)
  let [studentName, setstudentName] = useSafeState('')
  const data: string = LibNavigation.getArgsAll(props).data;
  const idclass: string = LibNavigation.getArgsAll(props).idclass;
  const course_id = LibNavigation.getArgsAll(props).courseId;
  const [ApiResponse, setResApi] = useSafeState<any>();
  let inputnotess = useRef<LibInput_rectangle2>(null)
  let [mappedData, setMappedData] = useState<any>({});
  interface CustomPopupProps {
    visible: boolean;
    onClose: () => void;
    nama: string;
    student_id?: number;
  }
  interface absentDialogProps {
    visible: boolean;
    onClose: () => void;
    student_id: number;
    nama: string;
  }

  const attenpost = () => {
    console.log("post.....")
    const url: string = "http://api.test.school.esoftplay.com/student_attendance"
    const post = {
      data: JSON.stringify(mappedData.student_list),
      course_id: course_id,
      schedule_id: data,
      class_id: idclass,
    }
    console.log("data yang di post", post)
    console.log()
    new LibCurl('student_attendance', post, (result, msg) => {
      console.log('Jadwal Result:', result);
      console.log(msg)
    }, (err) => {
      console.log("Eror")
      console.log(err)
    }, 1)
  }
  const date = moment().format('YYYY-MM-DD')
  useEffect(() => {

    console.log(moment().format('YYYY-MM-DD'))
    // jangan lupa ganti class_id dan schadule_id dan date di url 
    const url: string = "http://api.test.school.esoftplay.com/student_class?class_id=1&schedule_id=1&date=" + date

   
    console.log("class_id", idclass)
    console.log("schedule_id", data)
    new LibCurl("student_class?class_id="+idclass+"&schedule_id="+data+"&date=" + date, get,
      (result, msg) => {
        console.log('Jadwal Result:', result);
        console.log("msg", msg)
        setResApi(result)
        const data = JSON.stringify(result)
        setMappedData(result);
        console.log("link", url)
        console.log("data", data)
      },
      (err) => {
        console.log("error", err)
      }, 1)


  }, [])


  let timeStart = ApiResponse?.clock_start ?? ''
  let timeEnd = ApiResponse?.clock_end ?? ''
  let time: string = timeStart + " - " + timeEnd


  /*
  1=hadir,
  2-sakit,
  3=ijin,
  4-tidak
  hadir
  */
  //jangan lupa tambahin 
 

  // //menampilkan jumlah siswa hadir
  const studentsPresentArray = mappedData.student_list?.filter((student: { status: number; }) => student.status === 1) ?? []
  // //menampilkan jumlah siswa sakit
  const studentsSickArray = mappedData.student_list?.filter((student: { status: number; }) => student.status === 2) ?? [];
  // //menampilkan jumlah siswa ijin
  const studentsAbsentArray = mappedData.student_list?.filter((student: { status: number; }) => student.status === 3) ?? [];
  // //menampilkan jumlah siswa alfa
  const studentsAlphaArray = mappedData.student_list?.filter((student: { status: number; }) => student.status === 4) ?? [];

  const numberStudentsPresent = studentsPresentArray.length;
  const numberStudentsSick = studentsSickArray.length;
  const numberStudentsAbsent = studentsAbsentArray.length;
  const numberStudentsAlpha = studentsAlphaArray.length;
  
 let getStudentIcon = (statusCode: number) => {
    console.log(["status code", statusCode]);

    switch (statusCode) {
      case 1:
        setIcon('check' as MaterialIconsTypes)
        break;
      case 2:
        setIcon('emoticon-sick-outline' as MaterialIconsTypes)

        break;
      case 3:
        setIcon('exclamation' as MaterialIconsTypes)

        break;
      case 4:
        setIcon('close' as MaterialIconsTypes)

        break;
      default:
        setIcon('check' as MaterialIconsTypes)

    }

    return icon;
  }
  let PresentStatus = (indeks: number) => {
    console.clear()
    console.log("sebelum ganti status")
    console.log(mappedData.student_list[indeks].status)
    console.log("ganti status")
    mappedData.student_list[indeks].status = 1
    mappedData.student_list[indeks].notes = ''
    // a.permission.total_present=numberStudentsPresent
    getStudentIcon(1)
    console.log(mappedData.student_list[indeks].status)
    console.log("data a setelah ganti status", mappedData)
    setMappedData(mappedData)

  }
  let sickStatus = (indeks: number) => {
    console.clear()
    console.log("sebelum ganti status")
    console.log(mappedData.student_list[indeks].status)
    console.log("ganti status")
    mappedData.student_list[indeks].status = 2
    mappedData.student_list[indeks].notes = ''
    // a.permission.total_s=numberStudentsSick
    getStudentIcon(2)
    console.log(mappedData.student_list[indeks].status)
    console.log("data a setelah ganti status", mappedData)
    setMappedData(mappedData)
  }
  let absenceStatus = (indeks: number) => {
    console.clear()
    console.log("sebelum ganti status")
    console.log(mappedData.student_list[indeks].status)
    console.log("ganti status")
    mappedData.student_list[indeks].status = 3
    mappedData.student_list[indeks].notes = ''
    // a.permission.total_a=numberStudentsAbsent
    getStudentIcon(3)
    console.log(mappedData.student_list[indeks].status)
    console.log("data a setelah ganti status", mappedData)
    setMappedData(mappedData)
  }
  let alphaStatus = (indeks: number) => {
    console.clear()
    console.log("sebelum ganti status")
    console.log(mappedData.student_list[indeks].status)
    console.log("ganti status")
    mappedData.student_list[indeks].status = 4
    // a.permission.total_s=numberStudentsAlpha


    mappedData.student_list[indeks].notes = ''
    getStudentIcon(4)
    console.log(mappedData.student_list[indeks].status)
    console.log("data a setelah ganti status", mappedData)
    setMappedData(mappedData)
  }
  let absentNotes = (indeks: number) => {
    console.log("indeks", indeks)
    // a.permission.total_s=numberStudentsAbsent
    mappedData.student_list[indeks].notes = inputnotess?.current?.getText()
    console.log("data a setelah ganti status", mappedData)
    setMappedData(mappedData)
  }
  let [icon, setIcon] = useState<any>();


  function AbsentDialog({ visible, onClose, nama, student_id }: absentDialogProps): JSX.Element {

    let idS: number = student_id ?? 0

    return (
      <Modal
        transparent={true}
        visible={visible} >
        <View style={{ flex: 1, justifyContent: 'center', alignContent: 'center', backgroundColor: 'rgba(0, 0, 0, 0.116)', alignItems: 'center' }}>
          <View style={{ width: 300, padding: 20, backgroundColor: 'white', borderRadius: 10, alignItems: 'center', }}>
            {/* Text field */}
            <Text style={{ fontSize: 16, marginBottom: 10, }}>Alasan {nama}</Text>
            <LibInput_rectangle2
              placeholderTextColor='gray'
              // hint="Alasan"
              inputStyle={{ fontSize: 16, color: 'black', marginRight: 15, marginLeft: 8 }}
              ref={inputnotess}
              placeholder='Keterangan Ijin'
            />

            {/* ijin*/}
            <Pressable onPress={() => {
              esp.log(inputnotess?.current?.getText());
              onClose(),
                absenceStatus(idS), absentNotes(idS)
            }} style={{ marginTop: 10, padding: 10, backgroundColor: '#0083FD', borderRadius: 5, width: "100%", alignItems: 'center' }}>
              <Text style={{ color: 'white', fontSize: 16, }}>Ijinkan</Text>
            </Pressable>
          </View>
        </View>
      </Modal>
    );
  }
  function CustomPopup({ visible, onClose, nama, student_id }: CustomPopupProps): JSX.Element {

    console.log("student_id", student_id)
    let idS: number = student_id ?? 0
    // console.log("student_id type",typeof(student_id))
    return (
      <Modal
        transparent={true}
        visible={visible} >
        <View style={{ flex: 1, justifyContent: 'center', alignContent: 'center', backgroundColor: 'rgba(0, 0, 0, 0.116)', alignItems: 'center' }}>
          <View style={{ width: 300, padding: 20, backgroundColor: 'white', borderRadius: 10, alignItems: 'center', }}>
            {/* close button */}
            <TouchableOpacity onPress={onClose} style={{ backgroundColor: 'red', borderRadius: 50, padding: 10, position: 'absolute', right: -15, top: -15 }}>
              <LibIcon name="close" size={20} color="white" />
            </TouchableOpacity>
            <Text style={{ fontSize: 16, marginBottom: 10, }}>Ganti Status {nama}</Text>
            {/* Hadir */}
            <Pressable onPress={() => { onClose(), PresentStatus(idS) }} style={{ marginTop: 10, padding: 10, backgroundColor: '#0DBD5E', borderRadius: 5, width: "100%", alignItems: 'center' }}>
              <Text style={{ color: 'white', fontSize: 16, }}>Hadir</Text>
            </Pressable>
            {/* sakit */}
            <Pressable onPress={() => { onClose(), sickStatus(idS) }} style={{ marginTop: 10, padding: 10, backgroundColor: '#F6C956', borderRadius: 5, width: "100%", alignItems: 'center' }}>
              <Text style={{ color: 'white', fontSize: 16, }}>Sakit</Text>
            </Pressable>
            {/* alfa */}
            <Pressable onPress={() => { onClose(), alphaStatus(idS) }} style={{ marginTop: 10, padding: 10, backgroundColor: '#FF4343', borderRadius: 5, width: "100%", alignItems: 'center' }}>
              <Text style={{ color: 'white', fontSize: 16, }}>Alfa</Text>
            </Pressable>
            {/* ijin*/}
            <Pressable onPress={() => { onClose(), setIjinVisible(true) }} style={{ marginTop: 10, padding: 10, backgroundColor: '#0083FD', borderRadius: 5, width: "100%", alignItems: 'center' }}>
              <Text style={{ color: 'white', fontSize: 16, }}>Izin</Text>
            </Pressable>
          </View>
        </View>
      </Modal>
    );
  }

  return (
    <View style={{ flex: 1, backgroundColor: '#ffffff', alignContent: 'center', padding: 10 }}>
      {/* daftar siswa */}
      <FlatList data={ApiResponse?.student_list ?? []}
        showsVerticalScrollIndicator={false}
        contentContainerStyle={{ marginTop: LibStyle.STATUSBAR_HEIGHT, backgroundColor: 'white', paddingBottom: 75 }}
        ListHeaderComponent={
          <View >
            <View style={{ flexDirection: 'row', alignItems: 'center', height: 30, justifyContent: 'space-between' }}>
              <Pressable onPress={() => LibNavigation.replace('teacher/index')} style={{ alignItems: 'center', }}>
                <View style={{ flexDirection: 'row', alignItems: 'center', marginRight: 20 }}>
                  <LibIcon.EntypoIcons name="chevron-left" size={30} color="black" />
                  <Text style={{ fontSize: 20 }}>{ApiResponse?.class_name ?? ''}</Text>
                </View>
              </Pressable>
              <Text style={{ fontSize: 20 }}>{time}</Text>
            </View>

            <View style={{ flexDirection: 'row', justifyContent: 'space-evenly', marginTop: 10 }}>
              {/* Berangkat */}
              <View style={{ height: 80, width: 80, alignItems: 'center', backgroundColor: 'green', justifyContent: 'center', borderRadius: 10, padding: 12 }}>
                <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{numberStudentsPresent?? '0'}</Text>
                {/* <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{ApiResponse?.permission?.total_present ?? '0'}</Text> */}
                <Text style={{ fontSize: 12, fontWeight: 'bold', color: 'white' }}>Berangkat</Text>
              </View>
              {/* Sakit */}
              <View style={{ height: 80, width: 80, alignItems: 'center', backgroundColor: 'orange', justifyContent: 'center', borderRadius: 10, padding: 12 }}>
                {/* <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{ApiResponse?.permission?.total_s ?? '0'}</Text> */}
                <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{numberStudentsSick??'0'}</Text>
                <Text style={{ fontSize: 12, fontWeight: 'bold', color: 'white' }}>Sakit</Text>
              </View>
              {/* Izin */}
              <View style={{ height: 80, width: 80, alignItems: 'center', backgroundColor: '#0083fd', justifyContent: 'center', borderRadius: 10, padding: 12 }}>
                {/* <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{ApiResponse?.permission?.total_i ?? '0'}</Text> */}
                <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{numberStudentsAbsent?? '0'}</Text>
                <Text style={{ fontSize: 12, fontWeight: 'bold', color: 'white' }}>Ijin</Text>
              </View>
              {/* Alfa */}
              <View style={{ height: 80, width: 80, alignItems: 'center', backgroundColor: '#FF4343', justifyContent: 'center', borderRadius: 10, padding: 12 }}>
                {/* <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{ApiResponse?.permission?.total_a ?? '0'}</Text> */}
                <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{numberStudentsAlpha??'0'}</Text>
                <Text style={{ fontSize: 12, fontWeight: 'bold', color: 'white' }}>Alfa</Text>
              </View>

            </View>
            {/* seperator */}
            <View style={{ height: 5, width: 'auto', backgroundColor: 'gray', marginTop: 10, marginHorizontal: 10, justifyContent: 'center', borderRadius: 5 }} />
          </View>
        }
        keyExtractor={(item, index) => index.toString()}
        renderItem={
          ({ item, index }) => {

            function getStudentStatus(statusCode: number) {
              let status = '';

              switch (statusCode) {
                case 1:
                  status = 'Hadir';
                  break;
                case 2:
                  status = 'Sakit';
                  break;
                case 3:
                  status = 'Ijin';
                  break;
                case 4:
                  status = 'Tidak Hadir';
                  break;
                default:
                  status = 'Unknown';
              }

              return status;
            }
            function getStudentColor(statusCode: number) {
              let color = '';

              switch (statusCode) {
                case 1:
                  color = '#0DBD5E';
                  break;
                case 2:
                  color = 'orange';
                  break;
                case 3:
                  color = '#0083fd';
                  break;
                case 4:
                  color = '#FF4343';
                  break;

                default:
                  color = 'Unknown';
              }

              return color;
            }
            return (
              <View style={{ flexDirection: 'row', justifyContent: 'flex-start', marginTop: 10, alignItems: 'center', padding: 10, }}>
                <Pressable onPress={() => { setPopupVisible(true), setstudentId(index), setstudentName(item.name) }}>
                  <View style={{ flexDirection: 'row', justifyContent: 'flex-start', padding: 10, backgroundColor: getStudentColor(item.status), borderRadius: 10, height: 90, width: LibStyle.width - 40 }}>
                    <View style={{ marginLeft: 5, alignItems: 'center', padding: 5, backgroundColor: 'white', borderRadius: 10, justifyContent: 'center', width: 40 }}>
                      <Text style={{ fontSize: 20, fontWeight: 'bold' }}>{item.number ?? 0}</Text>
                    </View>
                    {/* nama siswa  && keterangan*/}
                    <View style={{ marginLeft: 10, alignItems: 'flex-start', justifyContent: 'center' }}>
                      <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{String(item.name) ?? "tejo"} </Text>

                      <View style={{ alignItems: 'center', padding: 5, backgroundColor: 'white', borderRadius: 5, justifyContent: 'center', marginTop: 10 }}>
                        <Text style={{ fontSize: 14, fontWeight: 'bold' }}>{getStudentStatus(item.status)} {index + 1} </Text>
                      </View>
                    </View>
                    <View style={{ flex: 1 }} />
                    <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white', alignSelf: 'baseline' }}>{item?.notes ?? ''}</Text>
                  </View>
                  {/* make a circle */}
                  {/*  style={{ backgroundColor: getStudentColor(item.status), borderRadius: 50, marginLeft: 20, padding: 20, height: 60, width: 60, alignItems: 'center', justifyContent: 'center' }} */}
                  {/* <LibIcon name={icon} size={34} color="#ffffff" /> */}
                </Pressable>
              </View>
            )
          }} />
      <CustomPopup visible={popupVisible} onClose={() => setPopupVisible(false)} student_id={studentId} nama={studentName} />
      <AbsentDialog visible={ijinVisible} onClose={() => setIjinVisible(false)} student_id={studentId} nama={studentName} />
      
      <View style={{ flexDirection: 'row', justifyContent: 'center', alignItems: 'center', padding: 10, height: 80 }}>
        <Pressable onPress={() => { console.log(mappedData), attenpost() }} style={{ backgroundColor: '#0083FD', borderRadius: 10, padding: 10, width: '80%', alignItems: 'center', height: 50, }}>
          <Text style={{ color: 'white', fontSize: 16, alignSelf: 'center' }}>Laporan</Text>
        </Pressable>
      </View>

    </View>
  )
}
export default memo(m);