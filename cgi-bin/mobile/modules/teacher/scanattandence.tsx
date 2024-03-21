// withHooks
import { memo } from 'react';

import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibInput_rectangle2 } from 'esoftplay/cache/lib/input_rectangle2/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import esp from 'esoftplay/esp';
import moment from 'esoftplay/moment';
import useSafeState from 'esoftplay/state';
import React, { useEffect, useRef, useState } from 'react';
import { FlatList, Modal, Pressable, Text, TouchableOpacity, View } from 'react-native';
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import { LibProgress } from 'esoftplay/cache/lib/progress/import';

export interface ScanAttendenceArgs {
}
export interface ScanAttendenceProps {
}


function m(props: ScanAttendenceProps): any {
    //data from previous screen
    // LibNavigation.navigate('teacher/scanattandence' ,{ data: data , schedule_id: schedule_id, class_id: class_id, course_id: course_id});
    const url: any = LibNavigation.getArgsAll(props).url;
    const schedule_id: any = LibNavigation.getArgsAll(props).schedule_id;
    const class_id: any = LibNavigation.getArgsAll(props).class_id;
    const course_id: any = LibNavigation.getArgsAll(props).course_id;

    useEffect(() => {
        console.log("url", url + "&schedule_id=" + schedule_id + "&date=" + date)
        new LibCurl(url + "&schedule_id=" + schedule_id + "&date=" + date, null,
            (result) => {
                console.log('Jadwal Result:', result);
                setStudentAttandenceApi(result)
                setstudentListAttandence(result.student_list)
                setMappedData(result);
            },
            (err) => {
                console.log("error", err)
            }, 1)


    }, [])

    //function post attandence
    const attenpost = () => {
        const url: string = "http://api.test.school.esoftplay.com/student_attendance"
        console.log("url", url)
        let dataabsen = JSON.stringify(mappedData.student_list)
        // console.log("data",JSON.stringify(mappedData.student_list))
        const post = {
            data: String(dataabsen),
            schedule_id: schedule_id,
            class_id: class_id,
            course_id: course_id,
            clock_start: StudentAttandence?.clock_start,
            clock_end: StudentAttandence?.clock_end,
        }
        console.log("data yang di post", post)
        LibProgress.show('Mengirim data')
        new LibCurl('student_attendance', post, (result, msg) => {
            LibProgress.hide()
            console.log(msg)
            LibNavigation.replace('teacher/index')
        }, (err) => {
            LibProgress.hide(),
                LibDialog.failed('Gagal mengirim data', 'Coba lagi')
            console.log(err)
        })
    }



    // get student attandence data
    const [StudentAttandence, setStudentAttandenceApi] = useSafeState<any>();
    const [studentListAttandence, setstudentListAttandence,] = useSafeState(StudentAttandence?.student_list ?? [])
    let [studentId, setstudentId] = useSafeState(0)
    let [studentName, setstudentName] = useSafeState('')

    //popup visible status
    const [popupVisible, setPopupVisible] = useState(false);
    const [ijinVisible, setIjinVisible] = useState(false)
    const [sickVisible, setSickVisible] = useState(false)

    //time
    const date = moment().format('YYYY-MM-DD')
    let timeStart = StudentAttandence?.clock_start ?? ''
    let timeEnd = StudentAttandence?.clock_end ?? ''
    let time: string = timeStart + " - " + timeEnd

    // Utils
    let inputnotess = useRef<LibInput_rectangle2>(null)
    let [mappedData, setMappedData] = useSafeState<any>({});
    const [actvebutton, setactvebutton] = useSafeState<number>(1);

    function getStatusString(status: number): string {
        switch (status) {
          case 1:
            return 'hadir';
          case 2:
            return 'hadir';
          case 3:
            return 'sakit';
          case 4:
            return 'ijin';
          case 5:
            return 'alfa';
          default:
            return '';
        }
      }
    const handlePress = (weeknum: number) => {
        setactvebutton(weeknum === actvebutton ? 0 : weeknum);
    };

    //popup interface
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


    //function change status student attandence
    /*  1=hadir,
        2-sakit,
        3=ijin,
        4-tidak hadir */

    function PresentStatus(index: number) {
        mappedData.student_list[index].status = 1;
        mappedData.student_list[index].notes = '';
        setMappedData({ ...mappedData });
    }
    function absenceStatus(indeks: number) {
        mappedData.student_list[indeks].status = 3
        mappedData.student_list[indeks].notes = ''
        setMappedData(mappedData)
    }
    function alphaStatus(indeks: number) {
        console.log(indeks)
        mappedData.student_list[indeks].status = 4
        mappedData.student_list[indeks].notes = '',
            setMappedData(mappedData)
    }
    //Array count student by status

    //menampilkan jumlah siswa hadir
    let studentsPresentArray = mappedData.student_list?.filter((student: { status: number; }) => student.status === 1) ?? []
    //menampilkan jumlah siswa sakit
    let studentsSickArray = mappedData.student_list?.filter((student: { status: number; }) => student.status === 2) ?? [];
    //menampilkan jumlah siswa ijin
    let studentsAbsentArray = mappedData.student_list?.filter((student: { status: number; }) => student.status === 3) ?? [];
    //menampilkan jumlah siswa alfa
    let studentsAlphaArray = mappedData.student_list?.filter((student: { status: number; }) => student.status === 4) ?? [];

    let numberStudentsPresent = studentsPresentArray.length;
    let numberStudentsSick = studentsSickArray.length;
    let numberStudentsAbsent = studentsAbsentArray.length;
    let numberStudentsAlpha = studentsAlphaArray.length;


    // popup function
    function AbsentDialog({ visible, onClose, nama, student_id }: absentDialogProps) {
        let absentNotes = (indeks: number) => {
            mappedData.student_list[indeks].notes = inputnotess?.current?.getText()
            setMappedData(mappedData)
        }
        let idSiswa: number = student_id ?? 0

        return (
            <Modal
                transparent={true}
                visible={visible} >
                <Pressable style={{ flex: 1, backgroundColor: 'rgba(0, 0, 0, 0.514)', justifyContent: 'center', alignItems: 'center' }} onPress={onClose}>
                </Pressable>

                <View style={{ width: '80%', padding: 20, backgroundColor: 'white', borderRadius: 10, alignItems: 'center', position: 'absolute', marginHorizontal: '10%', top: LibStyle.height / 4 }}>
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
                            absenceStatus(idSiswa), absentNotes(idSiswa)
                    }} style={{ marginTop: 10, padding: 10, backgroundColor: '#0083FD', borderRadius: 5, width: "100%", alignItems: 'center' }}>
                        <Text style={{ color: 'white', fontSize: 16, }}>Ijinkan</Text>
                    </Pressable>
                </View>

            </Modal>
        );
    }
    function SickDialog({ visible, onClose, nama, student_id }: absentDialogProps) {

        let idSiswa: number = student_id ?? 1
        let sickStatus = (indeks: number) => {
            mappedData.student_list[indeks].status = 2
            mappedData.student_list[indeks].notes = ''
            mappedData.student_list[indeks].notes = inputnotess?.current?.getText()
            setMappedData(mappedData)
        }
        return (
            <Modal
                transparent={true}
                visible={visible} >

                <Pressable style={{ flex: 1, backgroundColor: 'rgba(0, 0, 0, 0.514)', justifyContent: 'center', alignItems: 'center' }} onPress={onClose}>
                </Pressable>

                <View style={{ width: '80%', padding: 20, backgroundColor: 'white', borderRadius: 10, alignItems: 'center', position: 'absolute', marginHorizontal: '10%', top: LibStyle.height / 4 }}>
                    {/* Text field */}
                    <Text style={{ fontSize: 16, marginBottom: 10, }}>{nama}  Sakit </Text>
                    <LibInput_rectangle2
                        placeholderTextColor='gray'
                        // hint="Alasan"
                        inputStyle={{ fontSize: 16, color: 'black', marginRight: 15, marginLeft: 8 }}
                        ref={inputnotess}
                        placeholder='Keterangan Sakit'
                    />

                    {/* ijin*/}
                    <Pressable onPress={() => {
                        esp.log(inputnotess?.current?.getText());
                        onClose(), sickStatus(idSiswa)
                    }} style={{ marginTop: 10, padding: 10, backgroundColor: 'orange', borderRadius: 5, width: "100%", alignItems: 'center' }}>
                        <Text style={{ color: 'white', fontSize: 16, }}>Ijinkan</Text>
                    </Pressable>
                </View>

            </Modal>
        );
    }
    function CustomPopup({ visible, onClose, nama, student_id }: CustomPopupProps) {

        let idSiswa: number = student_id ?? 0
        // // console.log("student_id type",typeof(student_id))
        return (
            <Modal
                transparent={true}
                visible={visible} >
                <View style={{ flex: 1, justifyContent: 'center', alignContent: 'center', backgroundColor: 'rgba(0, 0, 0, 0.514)', alignItems: 'center' }}>
                    <View style={{ width: 300, padding: 20, backgroundColor: 'white', borderRadius: 10, alignItems: 'center', }}>
                        {/* close button */}
                        <TouchableOpacity onPress={onClose} style={{ backgroundColor: 'red', borderRadius: 50, padding: 10, position: 'absolute', right: -15, top: -15 }}>
                            <LibIcon name="close" size={20} color="white" />
                        </TouchableOpacity>
                        <Text style={{ fontSize: 16, marginBottom: 10, }}>Ganti Presensi {nama}</Text>
                        {/* Hadir */}
                        <Pressable onPress={() => { PresentStatus(idSiswa), onClose() }} style={{ marginTop: 10, padding: 10, backgroundColor: '#0DBD5E', borderRadius: 5, width: "100%", alignItems: 'center' }}>
                            <Text style={{ color: 'white', fontSize: 16, }}>Hadir</Text>
                        </Pressable>
                        {/* sakit */}
                        <Pressable onPress={() => { setSickVisible(true), onClose(), console.log("student_id", student_id) }} style={{ marginTop: 10, padding: 10, backgroundColor: '#F6C956', borderRadius: 5, width: "100%", alignItems: 'center' }}>
                            <Text style={{ color: 'white', fontSize: 16, }}>Sakit</Text>
                        </Pressable>
                        {/* alfa */}
                        <Pressable onPress={() => { alphaStatus(idSiswa), onClose() }} style={{ marginTop: 10, padding: 10, backgroundColor: '#FF4343', borderRadius: 5, width: "100%", alignItems: 'center' }}>
                            <Text style={{ color: 'white', fontSize: 16, }}>Alfa</Text>
                        </Pressable>
                        {/* ijin*/}
                        <Pressable onPress={() => { setIjinVisible(true), onClose() }} style={{ marginTop: 10, padding: 10, backgroundColor: '#0083FD', borderRadius: 5, width: "100%", alignItems: 'center' }}>
                            <Text style={{ color: 'white', fontSize: 16, }}>Izin</Text>
                        </Pressable>
                    </View>
                </View>
            </Modal>
        );
    }

    // filtered data by status
    const filterSickStudents = StudentAttandence?.student_list?.filter((student: { status: number; }) => student.status === 2) ?? []
    const filterAbsentStudents = StudentAttandence?.student_list?.filter((student: { status: number; }) => student.status === 3) ?? []
    const filterAlphaStudents = StudentAttandence?.student_list?.filter((student: { status: number; }) => student.status === 4) ?? []
    const filterPresentStudents = StudentAttandence?.student_list?.filter((student: { status: number; }) => student.status === 1) ?? []


    return (
        <View style={{ flex: 1, backgroundColor: '#ffffff', alignContent: 'center', padding: 10 }}>
            {/* daftar siswa */}
            <FlatList data={studentListAttandence ?? []}
                showsVerticalScrollIndicator={false}
                contentContainerStyle={{ marginTop: LibStyle.STATUSBAR_HEIGHT, backgroundColor: 'white', paddingBottom: 75 }}
                ListHeaderComponent={
                    <View >

                        <View style={{ flexDirection: 'row', alignItems: 'center', height: 30, justifyContent: 'space-between' }}>
                            <Pressable onPress={() => LibNavigation.replace('teacher/index')} style={{ alignItems: 'center', }}>
                                <View style={{ flexDirection: 'row', alignItems: 'center', marginRight: 20 }}>
                                    <LibIcon.EntypoIcons name="chevron-left" size={30} color="black" />
                                    <Text style={{ fontSize: 20 }}>{StudentAttandence?.class_name ?? ''}</Text>
                                </View>
                            </Pressable>
                            <Text style={{ fontSize: 20 }}>{time}</Text>
                        </View>

                        <View style={{ flexDirection: 'row', marginTop: 10, height: 80, justifyContent: 'center', flex: 1, alignItems: 'center' }}>
                            {/* All student */}
                            <View style={{ height: 70, flex: 1, alignItems: 'center', backgroundColor: 1 == actvebutton ? '#348121' : 'white', justifyContent: 'center', borderRadius: 10, marginHorizontal: 1, borderWidth: 2, borderColor: 1 == actvebutton ? 'white' : "#348121" }}>
                                <Pressable onPress={() => { setstudentListAttandence(StudentAttandence?.student_list ?? []), handlePress(1) }} style={{ alignItems: 'center', padding: 5, }}>
                                    {/* <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{StudentAttandence?.permission?.total_a ?? '0'}</Text> */}
                                    <Text style={{ fontSize: 16, fontWeight: 'bold', color: 1 == actvebutton ? 'white' : '#348121' }}>{StudentAttandence?.student_count ?? '0'}</Text>
                                    <Text style={{ fontSize: 10, fontWeight: 'bold', color: 1 == actvebutton ? 'white' : '#348121' }} allowFontScaling={true}>Semua Siswa</Text>
                                </Pressable>
                            </View>
                            {/* Berangkat */}
                            <View style={{ height: 70, flex: 1, alignItems: 'center', backgroundColor: 2 == actvebutton ? 'green' : 'white', justifyContent: 'center', borderRadius: 10, marginHorizontal: 1, borderWidth: 2, borderColor: 2 == actvebutton ? 'white' : "green" }}>
                                <Pressable onPress={() => { setstudentListAttandence(filterPresentStudents), handlePress(2) }} style={{ alignItems: 'center', padding: 5 }}>
                                    <Text style={{ fontSize: 16, fontWeight: 'bold', color: 2 == actvebutton ? 'white' : 'green' }}>{numberStudentsPresent ?? '0'}</Text>
                                    {/* <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{StudentAttandence?.permission?.total_present ?? '0'}</Text> */}
                                    <Text style={{ fontSize: 10, fontWeight: 'bold', color: 2 == actvebutton ? 'white' : 'green' }} allowFontScaling={true}>Berangkat</Text>
                                </Pressable>
                            </View>
                            {/* Sakit */}
                            <View style={{ height: 70, flex: 1, alignItems: 'center', backgroundColor: 3 == actvebutton ? 'orange' : 'white', justifyContent: 'center', borderRadius: 10, marginHorizontal: 1, borderWidth: 2, borderColor: 3 == actvebutton ? 'white' : "orange" }}>
                                <Pressable onPress={() => { setstudentListAttandence(filterSickStudents), handlePress(3) }} style={{ alignItems: 'center', padding: 5 }}>
                                    {/* <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{StudentAttandence?.permission?.total_s ?? '0'}</Text> */}
                                    <Text style={{ fontSize: 16, fontWeight: 'bold', color: 3 == actvebutton ? 'white' : 'orange' }}>{numberStudentsSick ?? '0'}</Text>
                                    <Text style={{ fontSize: 10, fontWeight: 'bold', color: 3 == actvebutton ? 'white' : 'orange' }} allowFontScaling={true}>Sakit</Text>
                                </Pressable>
                            </View>
                            {/* Izin */}
                            <View style={{ height: 70, flex: 1, alignItems: 'center', backgroundColor: 4 == actvebutton ? '#0083fd' : 'white', justifyContent: 'center', borderRadius: 10, marginHorizontal: 1, borderWidth: 2, borderColor: 4 == actvebutton ? 'white' : "#0083fd" }}>
                                <Pressable onPress={() => { setstudentListAttandence(filterAbsentStudents), handlePress(4) }} style={{ alignItems: 'center', padding: 5 }}>
                                    {/* <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{StudentAttandence?.permission?.total_i ?? '0'}</Text> */}
                                    <Text style={{ fontSize: 16, fontWeight: 'bold', color: 4 == actvebutton ? 'white' : '#0083fd' }}>{numberStudentsAbsent ?? '0'}</Text>
                                    <Text style={{ fontSize: 10, fontWeight: 'bold', color: 4 == actvebutton ? 'white' : '#0083fd' }} allowFontScaling={true}>Ijin</Text>
                                </Pressable>
                            </View>
                            {/* Alfa */}
                            <View style={{ height: 70, flex: 1, alignItems: 'center', backgroundColor: 5 == actvebutton ? '#FF4343' : 'white', justifyContent: 'center', borderRadius: 10, marginHorizontal: 1, borderWidth: 2, borderColor: 5 == actvebutton ? 'white' : "#FF4343" }}>
                                <Pressable onPress={() => { setstudentListAttandence(filterAlphaStudents), handlePress(5) }} style={{ alignItems: 'center', padding: 5 }}>
                                    {/* <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{StudentAttandence?.permission?.total_a ?? '0'}</Text> */}
                                    <Text style={{ fontSize: 16, fontWeight: 'bold', color: 5 == actvebutton ? 'white' : '#FF4343' }}>{numberStudentsAlpha ?? '0'}</Text>
                                    <Text style={{ fontSize: 10, fontWeight: 'bold', color: 5 == actvebutton ? 'white' : '#FF4343' }} allowFontScaling={true}>Alfa</Text>
                                </Pressable>
                            </View>
                        </View>
                        {/* seperator */}
                        <View style={{ height: 5, width: 'auto', backgroundColor: 'gray', marginHorizontal: 10, justifyContent: 'center', borderRadius: 5, marginTop: 12 }} />
                    </View>
                }

                ListEmptyComponent={() => {
                    return (
                      <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center',marginTop:20 }}>
                        <Text style={{ fontSize: 16, fontWeight: 'bold' }}>Tidak ada data murid yang {getStatusString(actvebutton)}</Text>
                      </View>
                    )
                  }
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
                            <Pressable onPress={() => { setPopupVisible(true), setstudentId(index), setstudentName(item?.name) }} style={{ flexDirection: 'row', justifyContent: 'flex-start', marginTop: 10, alignItems: 'center', borderColor: getStudentColor(item?.status), borderWidth: 3, borderRadius: 12, height: 90 }}>
                                <View style={{ height: 90, width: 10, borderBottomLeftRadius: 10, borderTopLeftRadius: 10, backgroundColor: getStudentColor(item?.status), }} />
                                <Text style={{ fontSize: 20, fontWeight: 'bold', marginHorizontal: 20, color: getStudentColor(item?.status) }}>{item?.number ?? 0}</Text>
                                <View style={{ height: 90, width: 2, backgroundColor: getStudentColor(item?.status), }} />

                                <View style={{ marginLeft: 10, alignItems: 'flex-start', justifyContent: 'center' }}>
                                    <Text style={{ fontSize: 16, fontWeight: 'bold' }}>{String(item?.name)} </Text>

                                    <View style={{ alignItems: 'center', padding: 5, backgroundColor: getStudentColor(item?.status), borderRadius: 5, justifyContent: 'center', marginTop: 10 }}>
                                        <Text style={{ fontSize: 14, fontWeight: 'bold', color: 'white' }}>{getStudentStatus(item?.status)} {item?.notes ?? ''} </Text>
                                    </View>

                                </View>
                                {/* <View style={{ flexDirection: 'row', justifyContent: 'flex-start', padding: 10, borderColor: getStudentColor(item?.status), borderRadius: 10, height: 90, width: LibStyle.width - 40,borderWidth:2 }}>
                        <View style={{ marginLeft: 5, alignItems: 'center', padding: 5, backgroundColor: 'white', borderRadius: 10, justifyContent: 'center', width: 40 }}>
                        </View>
                    
    
    
                      </View> */}
                                {/* make a circle */}
                                {/*  style={{ backgroundColor: getStudentColor(item?.status), borderRadius: 50, marginLeft: 20, padding: 20, height: 60, width: 60, alignItems: 'center', justifyContent: 'center' }} */}
                                {/* <LibIcon name={icon} size={34} color="#ffffff" /> */}

                            </Pressable>
                        )
                    }} />
            <CustomPopup visible={popupVisible} onClose={() => setPopupVisible(false)} student_id={studentId} nama={studentName} />
            <AbsentDialog visible={ijinVisible} onClose={() => setIjinVisible(false)} student_id={studentId} nama={studentName} />
            <SickDialog visible={sickVisible} onClose={() => setSickVisible(false)} student_id={studentId} nama={studentName} />
            {/* kirim */}
            <View style={{ flexDirection: 'row', justifyContent: 'center', alignItems: 'center', padding: 10, height: 80 }}>
                <Pressable onPress={() => {
                    console.log(mappedData),
                        LibDialog.confirm(' ', 'Apakah anda yakin untuk mengirim data absen?', 'ya', () => attenpost(), 'tidak', () => { })


                }} style={{ backgroundColor: '#0083FD', borderRadius: 10, padding: 10, width: '80%', alignItems: 'center', height: 50,justifyContent:'center' }}>
                    <Text style={{ color: 'white', fontSize: 14, alignSelf: 'center' }}>Kirim</Text>
                </Pressable>
            </View>

        </View>
    )
}
export default memo(m);